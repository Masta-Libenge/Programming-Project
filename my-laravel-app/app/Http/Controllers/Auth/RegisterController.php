<?php

// Define the namespace so Laravel can autoload the controller correctly
namespace App\Http\Controllers\Auth;

// Import the base controller class
use App\Http\Controllers\Controller;

// Import the User model to interact with the database
use App\Models\User;

// Import the Request class to handle incoming HTTP request data
use Illuminate\Http\Request;

// Import Hash to securely hash passwords
use Illuminate\Support\Facades\Hash;

// Import Auth to handle user authentication
use Illuminate\Support\Facades\Auth;

// Define the RegisterController class
class RegisterController extends Controller
{
    // 👩‍🎓 Show the student registration form
    public function showStudentRegisterForm()
    {
        // Return the view for the student registration page
        return view('auth.register_student');
    }

    // Handle student registration logic
    public function studentRegister(Request $request)
    {
        // Validate the form input: name is required, email must be valid and unique, password must be confirmed and at least 6 characters
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create a new user record in the database for the student
        $student = User::create([
            'name' => $request->name, // Store the student's name
            'email' => $request->email, // Store the email address
            'password' => Hash::make($request->password), // Hash and store the password
            'type' => 'student', // Set the user type to "student"
        ]);

        // Log in the student after successful registration
        Auth::login($student); // ✅ Correct Laravel method to authenticate user

        // Redirect the user to the student dashboard
        return redirect('/student/dashboard');
    }

    // 🏢 Show the company (bedrijf) registration form
    public function showBedrijfRegisterForm()
    {
        // Return the view for the company registration page
        return view('auth.register_bedrijf');
    }

    // Handle company registration logic
    public function bedrijfRegister(Request $request)
    {
        // Validate input: company_name is required, email must be unique, password must be confirmed and minimum 6 characters
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create a new user record in the database for the company
        $bedrijf = User::create([
            'name' => $request->company_name, // Store the company name as 'name'
            'email' => $request->email, // Store the company email
            'password' => Hash::make($request->password), // Hash and store the password
            'type' => 'bedrijf', // Set the user type to "bedrijf"
        ]);

        // Log in the company user after registration
        Auth::login($bedrijf); // ✅ Proper login function for Laravel

        // Redirect to the company dashboard route
        return redirect()->route('bedrijf.dashboard');
    }
}
