<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    \App\Models\Job::autoRejectOldPending();
    $user = auth()->user();
    
    // Handyman routing
    if ($user->Role === 'handyman') {
        $jobs = \App\Models\Job::with(['customer'])
            ->where('HandymanID', $user->UserID)
            ->get();
            
        $recentFeedback = \App\Models\Rating::with(['customer'])
            ->where('HandymanID', $user->UserID)
            ->latest()
            ->take(3)
            ->get();
            
        return view('handyman.dashboard', compact('jobs', 'recentFeedback'));
    }

    // Default Customer routing
    $jobs = \App\Models\Job::with(['handyman.ratings', 'customer'])
        ->where('CustomerID', $user->UserID)
        ->orWhere('HandymanID', $user->UserID)
        ->get();

    // Map through jobs to attach average rating to handyman
    $jobs->each(function($job) {
        if ($job->handyman) {
            $avg = $job->handyman->ratings->avg('Rating');
            $job->handyman->avg_rating = $avg ? round($avg, 1) : null;
        }
    });
        
    return view('dashboard', compact('jobs'));
})->name('dashboard')->middleware('auth');

use App\Http\Controllers\ProfileController;
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/become-professional', [ProfileController::class, 'becomeHandyman'])->name('profile.become_handyman');
});

use App\Http\Controllers\MarketplaceController;
Route::get('/services', [MarketplaceController::class, 'services'])->name('services.index');
Route::get('/professionals', [MarketplaceController::class, 'professionals'])->name('professionals.index');

use App\Http\Controllers\BookingController;
Route::middleware('auth')->group(function () {
    Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/book/slots', [BookingController::class, 'getBookedSlots'])->name('booking.slots');
    Route::post('/jobs/{job}/status', [BookingController::class, 'updateStatus'])->name('job.update_status');
});

use App\Http\Controllers\HistoryController;
Route::middleware('auth')->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/history/{job}/review', [HistoryController::class, 'submitReview'])->name('history.review');
});

use App\Http\Controllers\PaymentController;
Route::middleware('auth')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{job}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
    Route::post('/payments/{job}/pay', [PaymentController::class, 'processPayment'])->name('payments.process');
    Route::post('/payments/{job}/rate', [PaymentController::class, 'rateHandyman'])->name('payments.rate');
});

use App\Http\Controllers\ChatController;
Route::middleware('auth')->group(function () {
    Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/messages/{job}/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/messages/{job}/poll', [ChatController::class, 'poll'])->name('chat.poll');
});

Route::get('/run-migrations', function() {
    try {
        $out = '';
        $schema = Illuminate\Support\Facades\Schema::class;

        if (!$schema::hasColumn('handyman_jobs', 'JobImages')) {
            $schema::table('handyman_jobs', fn($t) => $t->json('JobImages')->nullable()->after('JobDesk'));
            $out .= 'Added JobImages column.<br>';
        }
        if (!$schema::hasColumn('handyman_jobs', 'JobStartDate')) {
            $schema::table('handyman_jobs', function($t) {
                $t->dateTime('JobStartDate')->nullable()->after('JobDuration');
                $t->dateTime('JobEndDate')->nullable()->after('JobStartDate');
            });
            $out .= 'Added JobStartDate/JobEndDate columns.<br>';
        }
        if (!$schema::hasColumn('handyman_jobs', 'JobPrice')) {
            $schema::table('handyman_jobs', fn($t) => $t->decimal('JobPrice', 10, 2)->nullable()->after('JobEndDate'));
            $out .= 'Added JobPrice column.<br>';
        }
        if (!$schema::hasColumn('handyman_jobs', 'InvoiceItems')) {
            $schema::table('handyman_jobs', fn($t) => $t->json('InvoiceItems')->nullable()->after('JobPrice'));
            $out .= 'Added InvoiceItems column.<br>';
        }
        if (!$schema::hasColumn('users', 'avatar')) {
            $schema::table('users', fn($t) => $t->string('avatar')->nullable());
            $out .= 'Added avatar column.<br>';
        }
        if (!$schema::hasColumn('users', 'rating')) {
            $schema::table('users', fn($t) => $t->decimal('rating', 3, 1)->nullable());
            $out .= 'Added rating column.<br>';
        }
        if (!$schema::hasColumn('users', 'Expertise')) {
            $schema::table('users', function($t) {
                $t->text('Expertise')->nullable();
                $t->json('Tags')->nullable();
            });
            $out .= 'Added Expertise/Tags columns.<br>';
        }
        if (!$schema::hasColumn('users', 'WorkingHoursStart')) {
            $schema::table('users', function($t) {
                $t->string('WorkingHoursStart', 5)->default('09:00');
                $t->string('WorkingHoursEnd', 5)->default('17:00');
            });
            $out .= 'Added WorkingHoursStart/WorkingHoursEnd columns.<br>';
        }
        if (!$schema::hasColumn('ratings', 'feedback')) {
            $schema::table('ratings', fn($t) => $t->text('feedback')->nullable()->after('Rating'));
            $out .= 'Added feedback column to ratings.<br>';
        }

        if (!$schema::hasTable('messages')) {
            $schema::create('messages', function($t) {
                $t->bigIncrements('MessageID');
                $t->unsignedBigInteger('JobID');
                $t->unsignedBigInteger('SenderID');
                $t->text('message');
                $t->boolean('is_read')->default(false);
                $t->timestamps();
                $t->index('JobID');
                $t->index('SenderID');
            });
            $out .= 'Created messages table.<br>';
        }

        return 'Migrations checked successfully!<br><br>' . ($out ?: 'All columns already exist. Nothing to migrate.');
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
