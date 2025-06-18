<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * 🧭 Show the student's profile page (view + inline edit toggle).
     */
    public function show()
    {
        $user = auth()->user();
        return view('student.profile', compact('user'));
    }

    /**
     * 📝 Update the student's profile info.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validate all editable fields
        $validated = $request->validate([
            'voornaam' => 'nullable|string|max:255',
            'achternaam' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'opleiding' => 'nullable|string|max:255',
            'jaar' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'card_color' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        // ✅ Update basic fields
        $user->voornaam = $validated['voornaam'] ?? $user->voornaam;
        $user->achternaam = $validated['achternaam'] ?? $user->achternaam;
        $user->email = $validated['email'];
        $user->opleiding = $validated['opleiding'] ?? $user->opleiding;
        $user->jaar = $validated['jaar'] ?? $user->jaar;

        // ✅ Always sync full `name` to voornaam + achternaam
        $user->name = trim(($user->voornaam ?? '') . ' ' . ($user->achternaam ?? ''));

        // ✅ Handle profile picture upload if needed
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('public/profile_pictures');
            $user->profile_picture = Storage::url($path);
        }

        $user->save();

        // ✅ Make sure the user has a linked profile row
        if (!$user->profile) {
            $user->profile()->create([]);
            $user->load('profile');
        }

        // ✅ Update profile-specific fields
        $user->profile->update([
            'description' => $validated['description'] ?? $user->profile->description,
            'card_color' => $validated['card_color'] ?? $user->profile->card_color,
        ]);

        return redirect()->back()->with('success', 'Profiel bijgewerkt!');
    }

    /**
     * 📸 Upload a new profile picture separately (optional, not used in your inline edit now).
     */
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if (!$user->profile) {
            $user->profile()->create([]);
            $user->load('profile');
        }

        $path = $request->file('profile_picture')->store('public/profile_pictures');

        $user->profile->update([
            'photo_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Profielfoto geüpload!');
    }

    /**
     * 🚫 Not needed anymore — the inline edit toggle replaces this.
     * Keeping for reference, but unused:
     */
    public function edit()
    {
        $user = Auth::user();
        return view('student.profile_edit', compact('user'));
    }
}
