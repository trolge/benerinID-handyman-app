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
    $jobs = \App\Models\Job::with(['handyman', 'customer'])
        ->where('CustomerID', $user->UserID)
        ->orWhere('HandymanID', $user->UserID)
        ->get();
        
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
    Route::post('/jobs/{job}/status', [BookingController::class, 'updateStatus'])->name('job.update_status');
});

use App\Http\Controllers\HistoryController;
Route::middleware('auth')->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});
