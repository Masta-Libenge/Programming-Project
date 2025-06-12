<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // 🎓 Student login
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

    // 🏢 Bedrijf login
    public function bedrijfLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password) || $user->type !== 'bedrijf') {
            return back()->withErrors(['login' => 'Ongeldige logingegevens voor bedrijf.']);
        }

        auth()->login($user);

        return redirect()->route('bedrijf.dashboard');
    }

    // 📄 Toon loginformulier voor studenten
    public function showStudentLoginForm()
    {
        return view('auth.login_student');
    }

    // 📄 Toon loginformulier voor bedrijven
    public function showBedrijfLoginForm()
    {
        return view('auth.login_bedrijf');
    }
}
