<?php

// Set the namespace so Laravel can autoload this controller properly
namespace App\Http\Controllers;

// Import the Request class to handle incoming HTTP form data
use Illuminate\Http\Request;

// Import the Vacature model to interact with the vacatures table in the database
use App\Models\Vacature;

// Define the controller class responsible for managing vacatures (job posts)
class VacatureController extends Controller
{
    /**
     * Show the form to create a new vacature (job post).
     */
    public function create()
    {
        // Return the view where users can fill in vacature details
        return view('vacature.create');
    }

    /**
     * Store a new vacature in the database.
     */
    public function store(Request $request)
    {
        // Validate the submitted form data before storing it
        $request->validate([
            'title' => 'required|string|max:255',        // Title is required, must be a string, max 255 characters
            'desc' => 'required|string',                 // Description is required and must be a string
            'type' => 'required|in:Stage,Werknemer',     // Type is required and must be either "Stage" or "Werknemer"
            'color' => 'required|string'                 // Color is required and must be a string
        ]);

        // Create a new vacature record in the database using mass assignment
        Vacature::create([
            'title' => $request->title,     // Store the title from the form
            'desc' => $request->desc,       // Store the description
            'type' => $request->type,       // Store the type (internship or job)
            'color' => $request->color,     // Store the selected color
        ]);

        // Redirect to the company dashboard with a success message
        return redirect()->route('bedrijf.dashboard')->with('success', 'Vacature succesvol toegevoegd.');
        // The `with()` method flashes a message to the session for display on the next page
    }
}
