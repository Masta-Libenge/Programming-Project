<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
   public function studentlogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    auth()->login($user);
    return redirect()->route('student.dashboard');
}


    public function showStudentLoginForm()
    {
        return view('auth.login_student');
    }

    public function showBedrijfLoginForm()
    {
        return view('auth.login_bedrijf');
    }
}
