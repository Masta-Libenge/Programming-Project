<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    { //Hier wordt in de DB gecheckt of deze persoons account bestaat.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:student,admin,bedrijf',
        ]);

        $user = User::where('email', $request->email)
            ->where('type', $request->role)
            ->first();
        // Redirect based on role
        return match ($user->type) {
            'student' => redirect()->route('student.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            'bedrijf' => redirect()->route('bedrijf.dashboard'),
        };
    }



}
