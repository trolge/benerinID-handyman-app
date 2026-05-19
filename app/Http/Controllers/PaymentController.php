<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Transaction;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Fetch finished jobs for the customer that do not have a transaction yet (unpaid)
        $unpaidJobs = Job::with(['handyman'])
            ->where('CustomerID', $user->UserID)
            ->where('JobStatus', 'finished')
            ->whereDoesntHave('transactions')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Fetch finished jobs that already have a transaction (paid)
        $paidJobs = Job::with(['handyman', 'transactions'])
            ->where('CustomerID', $user->UserID)
            ->where('JobStatus', 'finished')
            ->whereHas('transactions')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('payments.index', compact('unpaidJobs', 'paidJobs'));
    }

    public function checkout(Job $job)
    {
        $user = Auth::user();
        if ($job->CustomerID !== $user->UserID) {
            abort(403, 'Unauthorized access to invoice');
        }

        if ($job->JobStatus !== 'finished') {
            return redirect()->route('dashboard')->with('error', 'This job is not ready for payment yet.');
        }

        // Check if already paid
        if ($job->transactions()->exists()) {
            return redirect()->route('payments.index')->with('success', 'This invoice has already been paid!');
        }

        return view('payments.checkout', compact('job'));
    }

    public function processPayment(Request $request, Job $job)
    {
        $user = Auth::user();
        if ($job->CustomerID !== $user->UserID) {
            abort(403, 'Unauthorized access');
        }

        // Process Transaction
        $transaction = new Transaction();
        $transaction->JobID = $job->JobID;
        $transaction->HandymanID = $job->HandymanID;
        $transaction->CustomerID = $job->CustomerID;
        $transaction->save();

        // Execute payment CRC method
        $totalPrice = floatval($job->JobPrice) + 5.0; // Price + $5 Platform Fee
        $transaction->doPayment($totalPrice);

        return redirect()->route('payments.checkout', $job->JobID)->with('payment_success', true);
    }

    public function rateHandyman(Request $request, Job $job)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        if ($job->CustomerID !== $user->UserID) {
            abort(403, 'Unauthorized action');
        }

        // Check if rating already exists for this job
        $existing = Rating::where('JobID', $job->JobID)->first();
        if (!$existing) {
            Rating::rateHandyman([
                'JobID' => $job->JobID,
                'HandymanID' => $job->HandymanID,
                'CustomerID' => $user->UserID,
                'Rating' => $request->rating,
            ]);
        }

        return redirect()->route('payments.index')->with('success', 'Thank you for your rating!');
    }
}
