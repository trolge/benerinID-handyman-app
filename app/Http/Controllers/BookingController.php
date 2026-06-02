<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $handymanId = $request->query('handyman');
        $handyman = null;

        if ($handymanId) {
            $handyman = User::where('UserID', $handymanId)
                ->where('Role', 'handyman')
                ->first();
        }

        // If no specific handyman, show a list or redirect
        if (!$handyman) {
            return redirect()->route('professionals.index')
                ->with('error', 'Please select a professional to book.');
        }

        // Load handyman's average rating
        $avgRating = $handyman->ratings()->avg('Rating');
        $handyman->avg_rating = $avgRating ? round($avgRating, 1) : null;

        // Parse handyman tags
        $userTags = is_string($handyman->Tags) ? json_decode($handyman->Tags, true) ?? [] : (is_array($handyman->Tags) ? $handyman->Tags : []);
        $handymanTags = array_values(array_filter(array_map('ucwords', array_map('strtolower', array_map('trim', $userTags)))));
        if (empty($handymanTags)) {
            $handymanTags = ['Handyman']; // Fallback
        }

        // Load existing bookings for this handyman (non-cancelled)
        $existingBookings = Job::where('HandymanID', $handyman->UserID)
            ->whereNotIn('JobStatus', ['cancelled'])
            ->whereNotNull('JobStartDate')
            ->get(['JobStartDate', 'JobEndDate', 'JobDuration'])
            ->map(function ($job) {
                return [
                    'start' => $job->JobStartDate,
                    'end' => $job->JobEndDate,
                ];
            });

        return view('booking.create', compact('handyman', 'existingBookings', 'handymanTags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'JobName'      => 'required|string|max:255',
            'JobType'      => 'required|string|max:255',
            'JobDesk'      => 'required|string',
            'JobStartDate' => 'required|date',
            'HandymanID'   => 'required|exists:users,UserID',
            'JobImages.*'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'JobLocation'  => 'required|string|max:255',
            'JobLocationLat' => 'nullable|numeric',
            'JobLocationLng' => 'nullable|numeric',
        ]);

        $handyman = User::where('UserID', $validated['HandymanID'])
            ->where('Role', 'handyman')
            ->firstOrFail();

        $startDate = Carbon::parse($validated['JobStartDate']);

        // Server-side validation: no past dates
        if ($startDate->isPast()) {
            return back()->withErrors(['JobStartDate' => 'Cannot book a time in the past.'])->withInput();
        }

        // Server-side validation: working hours
        $workStart = $handyman->WorkingHoursStart ?? '09:00';
        $workEnd = $handyman->WorkingHoursEnd ?? '17:00';
        $bookingTime = $startDate->format('H:i');

        if ($bookingTime < $workStart || $bookingTime >= $workEnd) {
            return back()->withErrors(['JobStartDate' => "This handyman only works from {$workStart} to {$workEnd}."])->withInput();
        }

        // Server-side validation: no overlapping bookings
        $endDate = $startDate->copy()->addHours(2);
        $overlap = Job::where('HandymanID', $handyman->UserID)
            ->whereNotIn('JobStatus', ['cancelled'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->where('JobStartDate', '<', $endDate)
                      ->where('JobEndDate', '>', $startDate);
                });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['JobStartDate' => 'This time slot is already booked. Please choose another time.'])->withInput();
        }

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
            'JobLocation'  => $validated['JobLocation'],
            'JobLocationLat' => $validated['JobLocationLat'] ?? null,
            'JobLocationLng' => $validated['JobLocationLng'] ?? null,
            'JobStartDate' => $startDate,
            'JobEndDate'   => $endDate,
            'JobDuration'  => 2,
            'HandymanID'   => $handyman->UserID,
            'CustomerID'   => auth()->id(),
            'JobStatus'    => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'Your booking has been successfully created!');
    }

    /**
     * AJAX endpoint: returns booked slots for a handyman on a specific date.
     */
    public function getBookedSlots(Request $request)
    {
        $request->validate([
            'handyman_id' => 'required|exists:users,UserID',
            'date' => 'required|date_format:Y-m-d',
        ]);

        $date = $request->date;

        $bookings = Job::where('HandymanID', $request->handyman_id)
            ->whereNotIn('JobStatus', ['cancelled'])
            ->whereDate('JobStartDate', $date)
            ->get(['JobStartDate', 'JobEndDate'])
            ->map(function ($job) {
                return [
                    'start' => Carbon::parse($job->JobStartDate)->format('H:i'),
                    'end'   => Carbon::parse($job->JobEndDate)->format('H:i'),
                ];
            });

        return response()->json($bookings);
    }

    public function updateStatus(Request $request, Job $job)
    {
        $request->validate([
            'status' => 'required|in:accepted,cancelled,inspection,awaiting_approval,repairing,finished',
            'JobPrice' => 'required_if:status,awaiting_approval|numeric|min:0',
            'InvoiceItems' => 'nullable|array',
            'InvoiceItems.*.name' => 'required_with:InvoiceItems|string|max:255',
            'InvoiceItems.*.price' => 'required_with:InvoiceItems|numeric|min:0'
        ]);

        $user = auth()->user();
        
        // Authorization check
        if (in_array($request->status, ['repairing', 'cancelled'])) {
            if ($user->UserID !== $job->CustomerID && $user->UserID !== $job->HandymanID) {
                abort(403, 'Unauthorized status transition');
            }
        } else {
            if ($user->UserID !== $job->HandymanID) {
                abort(403, 'Only assigned handyman can update this status');
            }
        }

        $updateData = [
            'JobStatus' => $request->status
        ];

        // Save estimation (InvoiceItems) when status becomes 'awaiting_approval'
        if ($request->status === 'awaiting_approval') {
            if ($request->has('InvoiceItems')) {
                $items = [];
                $total = 0;
                foreach ($request->InvoiceItems as $item) {
                    if (!empty($item['name']) && isset($item['price'])) {
                        $price = floatval($item['price']);
                        $items[] = [
                            'name' => $item['name'],
                            'price' => $price
                        ];
                        $total += $price;
                    }
                }
                $updateData['InvoiceItems'] = $items;
                $updateData['JobPrice'] = $total > 0 ? $total : ($request->JobPrice ?? 0);
            } else if ($request->has('JobPrice')) {
                $updateData['JobPrice'] = $request->JobPrice;
                $updateData['InvoiceItems'] = null;
            }
        }

        $job->update($updateData);

        return redirect()->back()->with('success', 'Job status updated to ' . $request->status);
    }
}
