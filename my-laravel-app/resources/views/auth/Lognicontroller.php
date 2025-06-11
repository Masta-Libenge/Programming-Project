<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showStudentLoginForm()
    {
        return view('auth.login_student');
    }

    public function showBedrijfLoginForm()
    {
        return view('auth.login_bedrijf');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (!empty($email) && !empty($password)) {
            return redirect()->route('homepage');
        }

        return back()->withErrors([
            'login' => 'Email of wachtwoord ongeldig.',
        ]);
    }
}