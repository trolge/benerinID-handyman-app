<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Message;

class ChatController extends Controller
{
    /**
     * Show the messages page with conversation list + chat window.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $isHandyman = $user->Role === 'handyman';

        // Get all jobs that have messages OR are active (not cancelled), for this user
        $jobs = Job::with(['customer', 'handyman'])
            ->where(function ($q) use ($user) {
                $q->where('CustomerID', $user->UserID)
                  ->orWhere('HandymanID', $user->UserID);
            })
            ->whereNotIn('JobStatus', ['cancelled'])
            ->orderByDesc('updated_at')
            ->get();

        // Attach latest message and unread count to each job
        $jobs->each(function ($job) use ($user) {
            $job->latestMessage = Message::where('JobID', $job->JobID)
                ->latest()
                ->first();
            $job->unreadCount = Message::where('JobID', $job->JobID)
                ->where('SenderID', '!=', $user->UserID)
                ->where('is_read', false)
                ->count();
        });

        // Sort: jobs with messages first (most recent message), then jobs without messages
        $jobs = $jobs->sortByDesc(function ($job) {
            return $job->latestMessage ? $job->latestMessage->created_at->timestamp : 0;
        })->values();

        // If a specific job is selected
        $activeJobId = $request->query('job');
        $activeJob = null;
        $messages = collect();

        if ($activeJobId) {
            $activeJob = $jobs->firstWhere('JobID', $activeJobId);
            if ($activeJob) {
                $messages = Message::with('sender')
                    ->where('JobID', $activeJobId)
                    ->orderBy('created_at', 'asc')
                    ->get();

                // Mark messages as read
                Message::where('JobID', $activeJobId)
                    ->where('SenderID', '!=', $user->UserID)
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
            }
        } elseif ($jobs->isNotEmpty()) {
            // Auto-select the first job with messages, or just the first job
            $firstWithMsg = $jobs->first(fn($j) => $j->latestMessage !== null);
            $activeJob = $firstWithMsg ?? $jobs->first();
            if ($activeJob) {
                return redirect()->route('chat.index', ['job' => $activeJob->JobID]);
            }
        }

        return view('chat.index', compact('jobs', 'activeJob', 'messages', 'isHandyman'));
    }

    /**
     * Send a message (POST).
     */
    public function send(Request $request, Job $job)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $user = auth()->user();

        // Ensure user is part of this job
        if ($user->UserID !== $job->CustomerID && $user->UserID !== $job->HandymanID) {
            abort(403, 'You are not part of this job.');
        }

        Message::create([
            'JobID' => $job->JobID,
            'SenderID' => $user->UserID,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->route('chat.index', ['job' => $job->JobID]);
    }

    /**
     * AJAX: fetch new messages for polling.
     */
    public function poll(Request $request, Job $job)
    {
        $user = auth()->user();

        if ($user->UserID !== $job->CustomerID && $user->UserID !== $job->HandymanID) {
            return response()->json([], 403);
        }

        $afterId = $request->query('after', 0);

        $newMessages = Message::with('sender')
            ->where('JobID', $job->JobID)
            ->where('MessageID', '>', $afterId)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($user) {
                return [
                    'id' => $msg->MessageID,
                    'message' => $msg->message,
                    'sender_name' => $msg->sender ? $msg->sender->name : 'Unknown',
                    'sender_avatar' => $msg->sender && $msg->sender->avatar
                        ? asset('storage/' . $msg->sender->avatar)
                        : null,
                    'is_mine' => $msg->SenderID === $user->UserID,
                    'time' => $msg->created_at->format('g:i A'),
                    'date' => $msg->created_at->format('M d, Y'),
                ];
            });

        // Mark as read
        Message::where('JobID', $job->JobID)
            ->where('SenderID', '!=', $user->UserID)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($newMessages);
    }
}
