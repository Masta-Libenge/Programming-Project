<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * 🧭 Show the student's own profile edit page.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // ✅ Get the currently logged-in user (student)
        $user = Auth::user();

        // ✅ Use the new Blade view name:
        return view('student.profile_edit', compact('user'));
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

        if (!$user->profile) {
            $user->profile()->create([]);
            $user->load('profile');
        }

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
public function show()
{
    $user = auth()->user();   // ✅ variable is $user
    return view('student.profile', compact('user'));  // ✅ matches!
}


}
