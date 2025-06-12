<?php

namespace App\Http\Controllers\Auth; // Declares the namespace for organizing the controller within the Auth folder.

use App\Http\Controllers\Controller; // Imports the base controller class.
use App\Models\User; // Imports the User model to create new users in the database.
use Illuminate\Http\Request; // Handles HTTP requests (form submissions).
use Illuminate\Support\Facades\Hash; // Used to securely hash passwords.

class RegisterController extends Controller
{
    // 👩‍🎓 Student registratie
    public function showStudentRegisterForm()
    {
        // Returns the view that contains the student registration form
        return view('auth.register_student');
    }

    public function studentRegister(Request $request)
    {
        // Validates the form input: all fields are required and must match the rules
        $request->validate([
            'name' => 'required|string|max:255', // Name must be a string, max 255 chars
            'email' => 'required|email|unique:users', // Email must be valid and unique in the users table
            'password' => 'required|confirmed|min:6', // Password must match confirmation and be at least 6 chars
        ]);

        // Creates a new user with the role "student"
        $student = User::create([
            'name' => $request->name, // Gets name from form input
            'email' => $request->email, // Gets email from form input
            'password' => Hash::make($request->password), // Hashes the password for secure storage
            'type' => 'student', // Sets user type as 'student'
        ]);

        // Automatically logs in the new student
        auth()->login($student);

        // Redirects to the student dashboard
        return redirect('/student/dashboard');
    }

    // 🏢 Bedrijf registratie
    public function showBedrijfRegisterForm()
    {
        // Returns the view that contains the company (bedrijf) registration form
        return view('auth.register_bedrijf');
    }

    public function bedrijfRegister(Request $request)
    {
        // Validates the company registration input
        $request->validate([
            'company_name' => 'required|string|max:255', // Company name is required
            'email' => 'required|email|unique:users', // Email must be valid and unique
            'password' => 'required|confirmed|min:6', // Password validation rules
        ]);

        // Creates a new user with the role "bedrijf" (company)
        $bedrijf = User::create([
            'name' => $request->company_name, // Uses company_name as the user's name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'bedrijf', // Sets user type as 'bedrijf'
        ]);

        // Automatically logs in the new company user
        auth()->login($bedrijf);

        // Redirects to the company dashboard using a named route
        return redirect()->route('bedrijf.dashboard');
    }
}
