<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('student.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'voornaam' => 'nullable|string|max:255',
            'achternaam' => 'nullable|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'opleiding' => 'nullable|string|max:255',
            'jaar' => 'nullable|string|max:10',
            'vaardigheden' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('student.profile.show')->with('success', 'Profiel bijgewerkt.');
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        return redirect()->route('student.profile.show')->with('success', 'Profielfoto bijgewerkt.');
    }
}
