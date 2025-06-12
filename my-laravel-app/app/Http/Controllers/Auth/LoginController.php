<?php

namespace App\Http\Controllers\Auth; // Organizes this controller under the Auth namespace

use App\Http\Controllers\Controller; // Imports the base controller class
use Illuminate\Http\Request; // Enables access to HTTP request data
use App\Models\User; // Gives access to the User model for querying the database
use Illuminate\Support\Facades\Hash; // Allows secure password checking with hashing

class LoginController extends Controller
{
    // 🎓 Handles student login
    public function studentlogin(Request $request)
    {
        // Step 1: Validate the form input
        $request->validate([
            'email' => 'required|email',   // Email is required and must be valid
            'password' => 'required',      // Password is required
        ]);

        // Step 2: Look up a user by email in the database
        $user = User::where('email', $request->email)->first();

        // Step 3: Check if user exists AND the hashed password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            // If email not found or password doesn't match, redirect back with error
            return back()->withErrors(['login' => 'Invalid credentials']);
        }

        // Step 4: Log the user in (starts session, sets auth state)
        
        auth()->login($user);

        // Step 5: Redirect to student dashboard after successful login
        return redirect()->route('student.dashboard');
    }

    // Shows the login form for students
    public function showStudentLoginForm()
    {
        return view('auth.login_student'); // Returns the Blade view for student login
    }

    // Shows the login form for companies (bedrijven)
    public function showBedrijfLoginForm()
    {
        return view('auth.login_bedrijf'); // Returns the Blade view for bedrijf login
    }
}
