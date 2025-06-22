<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * 🧭 Show the student's profile page.
     */
    public function show()
    {
        $user = auth()->user();
        return view('student.profile', compact('user'));
    }

    /**
     * 📝 Update the student's profile info including profile picture.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validate all fields
        $validated = $request->validate([
            'voornaam' => 'nullable|string|max:255',
            'achternaam' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'opleiding' => 'nullable|string|max:255',
            'jaar' => 'nullable|string|max:255',
            'vaardigheden' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:500',
            'card_color' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // ✅ Update user basic fields
        $user->voornaam = $validated['voornaam'] ?? $user->voornaam;
        $user->achternaam = $validated['achternaam'] ?? $user->achternaam;
        $user->email = $validated['email'];
        $user->opleiding = $validated['opleiding'] ?? $user->opleiding;
        $user->jaar = $validated['jaar'] ?? $user->jaar;
        $user->vaardigheden = $validated['vaardigheden'] ?? $user->vaardigheden;
        $user->name = trim(($user->voornaam ?? '') . ' ' . ($user->achternaam ?? ''));

        // ✅ Correctly handle profile picture
        if ($request->hasFile('profile_picture')) {
            // Delete old if exists
            if ($user->profile_picture && Storage::exists(str_replace('storage/', 'public/', $user->profile_picture))) {
                Storage::delete(str_replace('storage/', 'public/', $user->profile_picture));
            }

            // Store new
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = 'storage/' . $path;
        }

        $user->save();

        // ✅ Ensure profile table exists
        if (!$user->profile) {
            $user->profile()->create([]);
            $user->load('profile');
        }

        // ✅ Update profile row
        $user->profile->update([
            'description' => $validated['description'] ?? $user->profile->description,
            'card_color' => $validated['card_color'] ?? $user->profile->card_color,
        ]);

        return back()->with('success', 'Profiel bijgewerkt!');
    }

    /**
     * 📸 Optional: separate uploader if needed.
     */
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Delete old if exists
        if ($user->profile_picture && Storage::exists(str_replace('storage/', 'public/', $user->profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $user->profile_picture));
        }

        // Store new
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = 'storage/' . $path;
        $user->save();

        return back()->with('success', 'Profielfoto geüpload!');
    }

    /**
     * 🚫 Legacy.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('student.profile_edit', compact('user'));
    }
}
