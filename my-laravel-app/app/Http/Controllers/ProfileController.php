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
        // ✅ Validate incoming fields: description and card color
        $request->validate([
            'description' => 'nullable|string|max:500',
            'card_color' => 'nullable|string|max:20',
        ]);

        // ✅ Update the user with the new values
        $user = Auth::user();
        $user->description = $request->input('description');
        $user->card_color = $request->input('card_color');
        $user->save();

        // ✅ Redirect back with a success message
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
        // ✅ Validate the uploaded file: must be an image max 2MB
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // ✅ Store the uploaded file in 'public/profile_pictures'
        $path = $request->file('profile_picture')->store('public/profile_pictures');

        // ✅ Optionally delete the old picture if you want:
        // Storage::delete($user->profile_picture);

        // ✅ Save the new path
        $user->profile_picture = $path;
        $user->save();

        return redirect()->back()->with('success', 'Profielfoto geüpload!');
    }
}
