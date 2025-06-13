<?php

// Define the namespace so Laravel can autoload this controller.
namespace App\Http\Controllers\Auth;

// Base Controller import.
use App\Http\Controllers\Controller;

// Handles incoming HTTP requests.
use Illuminate\Http\Request;

// User model to query the users table.
use App\Models\User;

// Hash facade for secure password checking.
use Illuminate\Support\Facades\Hash;

// Define the LoginController to manage different user login types.
class LoginController extends Controller
{
    // 🎓 Handles login logic for students
    public function studentlogin(Request $request)
    {
        // Validate the submitted email and password.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email.
        $user = User::where('email', $request->email)->first();

        // If no user found or password is incorrect, return error.
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Invalid credentials']);
        }

        // If the user is an admin, redirect to the admin dashboard instead.
        if ($user->type === 'admin') {
            auth()->login($user);
            return redirect()->route('admin.dashboard'); // 👈 Make sure this route exists
        }

        // If the user is not a student, block the login attempt.
        if ($user->type !== 'student') {
            return back()->withErrors(['login' => 'You are not authorized to log in as a student.']);
        }

        // All checks passed — log in the student.
        auth()->login($user);
        return redirect()->route('student.dashboard');
    }

    // 🏢 Handles login logic for companies (bedrijven)
    public function bedrijfLogin(Request $request)
    {
        // Validate the email and password fields.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Try to find the user by email.
        $user = User::where('email', $request->email)->first();

        // Reject if no user or wrong password.
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Ongeldige logingegevens.']);
        }

        // Redirect admins to their own dashboard.
        if ($user->type === 'admin') {
            auth()->login($user);
            return redirect()->route('admin.dashboard'); // 👈 Make sure this route exists
        }

        // Block access if the user is not a company.
        if ($user->type !== 'bedrijf') {
            return back()->withErrors(['login' => 'Je bent niet gemachtigd om als bedrijf in te loggen.']);
        }

        // Log in the company user.
        auth()->login($user);
        return redirect()->route('bedrijf.dashboard');
    }

    // 📄 Returns the student login form view
    public function showStudentLoginForm()
    {
        return view('auth.login_student');
    }

    // 📄 Returns the company login form view
    public function showBedrijfLoginForm()
    {
        return view('auth.login_bedrijf');
    }
}
