<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        Job::autoRejectOldPending();
        $user = Auth::user();
        
        if ($user && $user->Role === 'handyman') {
            $jobs = Job::with(['customer', 'ratings'])
                ->where('HandymanID', $user->UserID)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $jobs = Job::with(['handyman.ratings', 'ratings'])
                ->where('CustomerID', $user->UserID ?? Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();

            // Map through jobs to attach average rating to handyman
            $jobs->each(function($job) {
                if ($job->handyman) {
                    $avg = $job->handyman->ratings->avg('Rating');
                    $job->handyman->avg_rating = $avg ? round($avg, 1) : null;
                }
            });
        }
            
        return view('history.index', compact('jobs'));
    }

    public function submitReview(Request $request, Job $job)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        
        // Ensure the user is the customer for this job
        if ($job->CustomerID !== $user->UserID) {
            abort(403, 'Unauthorized action');
        }

        // Ensure job is finished
        if ($job->JobStatus !== 'finished') {
            return redirect()->route('history.index')->with('error', 'You can only review completed jobs.');
        }

        // Check if rating already exists for this job by this customer
        $existing = Rating::where('JobID', $job->JobID)
            ->where('CustomerID', $user->UserID)
            ->first();

        if ($existing) {
            // Update existing review
            $existing->update([
                'Rating' => $request->rating,
                'feedback' => $request->feedback,
            ]);
        } else {
            // Create new review
            Rating::rateHandyman([
                'JobID' => $job->JobID,
                'HandymanID' => $job->HandymanID,
                'CustomerID' => $user->UserID,
                'Rating' => $request->rating,
                'feedback' => $request->feedback,
            ]);
        }

        return redirect()->route('history.index')->with('success', 'Thank you for your review!');
    }
}
