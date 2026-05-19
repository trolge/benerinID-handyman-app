<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.settings', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->UserID . ',UserID',
            'PhoneNumber' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->PhoneNumber = $request->PhoneNumber;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Store new and save path
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Handle Handyman specific fields
        if (strtolower($user->Role) === 'handyman') {
            if ($request->has('Expertise')) {
                $user->Expertise = $request->Expertise;
            }
            
            if ($request->has('Tags')) {
                // Parse comma separated list into JSON array
                $rawTags = explode(',', $request->Tags);
                $cleanTags = array_values(array_filter(array_map('trim', $rawTags)));
                $user->Tags = json_encode($cleanTags);
            }

            if ($request->has('WorkingHoursStart')) {
                $user->WorkingHoursStart = $request->WorkingHoursStart;
            }
            if ($request->has('WorkingHoursEnd')) {
                $user->WorkingHoursEnd = $request->WorkingHoursEnd;
            }
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function becomeHandyman(Request $request)
    {
        $user = auth()->user();
        
        if (strtolower($user->Role) === 'customer') {
            $user->Role = 'handyman';
            $user->save();
            return redirect()->route('profile.edit')->with('success', 'Congratulations! Your account has been upgraded to a Professional.');
        }

        return redirect()->route('profile.edit');
    }
}
