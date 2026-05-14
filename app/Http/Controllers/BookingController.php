<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'JobName'      => 'required|string|max:255',
            'JobType'      => 'required|string|max:255',
            'JobDesk'      => 'required|string',
            'JobStartDate' => 'required|date',
            'JobImages.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Attempt to assign a random active Handyman for the marketplace
        $handyman = User::where('Role', 'Handyman')->inRandomOrder()->first();

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('JobImages')) {
            foreach ($request->file('JobImages') as $image) {
                $imagePaths[] = $image->store('job_images', 'public');
            }
        }

        Job::create([
            'JobName'      => $validated['JobName'],
            'JobType'      => $validated['JobType'],
            'JobDesk'      => $validated['JobDesk'],
            'JobImages'    => !empty($imagePaths) ? $imagePaths : null,
            'JobStartDate' => $validated['JobStartDate'],
            'JobEndDate'   => Carbon::parse($validated['JobStartDate'])->addHours(2),
            'JobDuration'  => 2,
            'HandymanID'   => $handyman ? $handyman->UserID : null,
            'CustomerID'   => auth()->id(),
            'JobStatus'    => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'Your booking has been successfully created!');
    }

    public function updateStatus(Request $request, Job $job)
    {
        $request->validate([
            'status' => 'required|in:accepted,cancelled,inspection,repairing,finished',
            'JobPrice' => 'required_if:status,finished|numeric|min:0'
        ]);

        if (auth()->id() !== $job->HandymanID) {
            abort(403);
        }

        $updateData = [
            'JobStatus' => $request->status
        ];

        // Invoice logic: Apply manual charge strictly when officially completing the job.
        if ($request->status === 'finished' && $request->has('JobPrice')) {
            $updateData['JobPrice'] = $request->JobPrice;
        }

        $job->update($updateData);

        return redirect()->back()->with('success', 'Job status updated to ' . $request->status);
    }
}
