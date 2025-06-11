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
            'type' => 'required|in:student,admin,bedrijf',
        ]);

        $user = User::where('email', $request->email)
                    ->where('type', $request->type) // ✅ match form input
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Invalid credentials']);
        }

        auth()->login($user);

        return match ($user->type) {
            'student' => redirect()->route('student.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            'bedrijf' => redirect()->route('bedrijf.dashboard'),
        };
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
