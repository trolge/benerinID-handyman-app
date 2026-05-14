<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user && $user->Role === 'handyman') {
            $jobs = Job::with('customer')
                ->where('HandymanID', $user->UserID)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $jobs = Job::with('handyman')
                ->where('CustomerID', $user->UserID ?? Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }
            
        return view('history.index', compact('jobs'));
    }
}
