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
     * 🎓 Handle login for students
     * -----------------------------
     * - Validate input
     * - Find user by email
     * - Check password
     * - Block non-student users
     * - Redirect to student dashboard if successful
     */
    public function studentlogin(Request $request)
    {
        // 1️⃣ Validate email & password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2️⃣ Find user by email
        $user = User::where('email', $request->email)->first();

        // 3️⃣ If no user or wrong password, return error
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Ongeldige logingegevens']);
        }

        // 4️⃣ If admin, send to admin dashboard instead
        if ($user->type === 'admin') {
            auth()->login($user);
            return redirect()->route('admin.dashboard');
        }

        // 5️⃣ Block non-student logins here
        if ($user->type !== 'student') {
            return back()->withErrors(['login' => 'Je bent niet gemachtigd om als student in te loggen']);
        }

        // 6️⃣ Login OK → log in & go to student dashboard
        auth()->login($user);
        return redirect()->route('student.dashboard');
    }

    /**
     * 🏢 Handle login for companies (bedrijven)
     * -----------------------------------------
     * - Validate input
     * - Find user by email
     * - Check password
     * - Block non-company users
     * - Redirect to company dashboard if successful
     */
    public function bedrijfLogin(Request $request)
    {
        // 1️⃣ Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2️⃣ Find user by email
        $user = User::where('email', $request->email)->first();

        // 3️⃣ If no user or wrong password, return error
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Ongeldige logingegevens.']);
        }

        // 4️⃣ If admin, send to admin dashboard
        if ($user->type === 'admin') {
            auth()->login($user);
            return redirect()->route('admin.dashboard');
        }

        // 5️⃣ Block non-company logins
        if ($user->type !== 'bedrijf') {
            return back()->withErrors(['login' => 'Je bent niet gemachtigd om als bedrijf in te loggen.']);
        }

        // 6️⃣ Login OK → log in & go to bedrijf dashboard
        auth()->login($user);
        return redirect()->route('bedrijf.dashboard');
    }

    /**
     * 📄 Show the student login form
     */
    public function showStudentLoginForm()
    {
        return view('auth.login_student');
    }

    /**
     * 📄 Show the company login form
     */
    public function showBedrijfLoginForm()
    {
        return view('auth.login_bedrijf');
    }

    /**
     * 🚪 UNIVERSAL logout method
     * ---------------------------
     * - Logs out any user
     * - Invalidates session
     * - Regenerates CSRF token
     * - Redirects to homepage
     */
    public function logout(Request $request)
    {
        // 1️⃣ Log out user
        Auth::logout();

        // 2️⃣ Invalidate the session to prevent reuse
        $request->session()->invalidate();

        // 3️⃣ Regenerate CSRF token for security
        $request->session()->regenerateToken();

        // 4️⃣ Redirect to homepage after logout
        return redirect('/');
    }
}
