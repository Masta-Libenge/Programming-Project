<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 🖼️ Toon het centrale loginformulier
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * 🔐 Verwerk login voor student of bedrijf
     * ----------------------------------------
     * - Valideert e-mail en wachtwoord
     * - Controleert of gebruiker bestaat en wachtwoord klopt
     * - Stelt gebruikersrol vast ('student', 'bedrijf', 'admin')
     * - Stuur naar juiste dashboard op basis van type
     */
    public function login(Request $request)
    {
        // 1️⃣ Valideer de input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2️⃣ Probeer in te loggen met gegeven credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // 3️⃣ Doorverwijzen op basis van type
            switch ($user->type) {
                case 'student':
                    return redirect()->route('student.dashboard');
                case 'bedrijf':
                    return redirect()->route('bedrijf.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['type' => 'Ongeldige gebruikersrol.']);
            }
        }

        // 4️⃣ Mislukte login
        return back()->withErrors(['email' => 'Inloggegevens kloppen niet.']);
    }

    /**
     * 🚪 Universele logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
