<?php

// Define the namespace for this controller class so it can be autoloaded correctly.
namespace App\Http\Controllers\Auth;

// Import the base Controller class.
use App\Http\Controllers\Controller;

// Import the Request class to handle HTTP requests.
use Illuminate\Http\Request;

// Import the User model to interact with the users table in the database.
use App\Models\User;

// Import the Hash facade to securely check hashed passwords.
use Illuminate\Support\Facades\Hash;

// Define the LoginController class that extends the base Controller.
class LoginController extends Controller
{
    // 🎓 Method for handling student login logic
    public function studentlogin(Request $request)
    {
        // Validate that the 'email' and 'password' fields are provided and the email is properly formatted.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Try to find a user in the database by the provided email address.
        $user = User::where('email', $request->email)->first();

        // Check if no user was found, or if the password is incorrect.
        if (!$user || !Hash::check($request->password, $user->password) || $user->type !== 'student') {
            // If validation fails, redirect back with an error message.
            return back()->withErrors(['login' => 'Invalid credentials']);
        }

        // If login is successful, log the user in using Laravel's auth system.
        auth()->login($user);

        // Redirect the user to the student dashboard route.
        return redirect()->route('student.dashboard');
    }

    // 🏢 Method for handling company (bedrijf) login logic
    public function bedrijfLogin(Request $request)
    {
        // Validate that the 'email' and 'password' fields are filled in correctly.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Look up the user with the given email in the database.
        $user = User::where('email', $request->email)->first();

        // Check if the user doesn't exist, the password is wrong, or the user is not of type 'bedrijf'.
        if (!$user || !Hash::check($request->password, $user->password) || $user->type !== 'bedrijf') {
            // If any of the conditions fail, show an error message specific to company login.
            return back()->withErrors(['login' => 'Ongeldige logingegevens voor bedrijf.']);
        }

        // Log in the user if all checks pass.
        auth()->login($user);

        // Redirect to the company (bedrijf) dashboard.
        return redirect()->route('bedrijf.dashboard');
    }

    // 📄 Show the login form view for students
    public function showStudentLoginForm()
    {
        // Return the view that shows the student login form.
        return view('auth.login_student');
    }

    // 📄 Show the login form view for companies
    public function showBedrijfLoginForm()
    {
        // Return the view that shows the company login form.
        return view('auth.login_bedrijf');
    }
}
