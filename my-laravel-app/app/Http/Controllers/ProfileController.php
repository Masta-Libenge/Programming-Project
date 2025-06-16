<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * 🧭 Show the student's own profile page.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // ✅ Get the currently logged-in user (student)
        $user = Auth::user();

        // ✅ Pass the user to the 'student.profile' Blade view
        return view('student.profile', compact('user'));
    }

    /**
     * 📝 Update the student's profile info (description, card color, etc).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:500',
            'card_color' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        // ✅ Make sure the user has a profile; create one if missing
        if (!$user->profile) {
            $user->profile()->create([]);
             $user->load('profile'); // <--- FIX: reload the relation!
        }

        // ✅ Update the profile fields (NOT on User)
        $user->profile->update([
            'description' => $request->input('description'),
            'card_color' => $request->input('card_color'),
        ]);

        return redirect()->back()->with('success', 'Profiel bijgewerkt!');
    }

    /**
     * 📸 Upload a new profile picture for the student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // ✅ Make sure the user has a profile; create one if missing
        if (!$user->profile) {
            $user->profile()->create([]);
        }

        // ✅ Store the uploaded file in 'public/profile_pictures'
        $path = $request->file('profile_picture')->store('public/profile_pictures');

        // ✅ Optionally delete the old picture if you want:
        // Storage::delete($user->profile->photo_path);

        // ✅ Save the new path on the Profile (NOT on User)
        $user->profile->update([
            'photo_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Profielfoto geüpload!');
    }
}
