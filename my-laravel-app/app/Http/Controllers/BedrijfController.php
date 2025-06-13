<?php

// Define the controller's namespace for Laravel's autoloading and routing
namespace App\Http\Controllers\Auth;

// Import the base controller class to inherit controller functionality
use App\Http\Controllers\Controller;

// Import the Request class, though it's not used in this snippet, it’s commonly imported for handling form input
use Illuminate\Http\Request;

// Import the User model to interact with users in the database
use App\Models\User;

// Define the BedrijfController class for handling company-related actions
class BedrijfController extends Controller
{
    // Define a method to show the dashboard view for a company (bedrijf)
    public function dashboard()
    {
        // Retrieve all users from the database where the type is 'student'
        $students = User::where('type', 'student')->get();

        // Return the bedrijf dashboard view, passing the list of students to it
        return view('bedrijf.dashboard', compact('students'));
        // `compact('students')` creates an array ['students' => $students] to be used in the view
    }
}
