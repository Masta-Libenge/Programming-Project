<?php

// Set the namespace so Laravel can autoload this controller properly
namespace App\Http\Controllers;

// Import the Request class to handle incoming HTTP form data
use Illuminate\Http\Request;

// Import the Vacature model to interact with the vacatures table in the database
use App\Models\Sollicitatie;
use App\Models\Vacature;
use App\Models\MailMessage;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        // Fetch all vacatures from the database
        $vacatures = Vacature::all();
        $categories = [
            'Alle vacatures',
            'Stage',
            'Werknemer',
        ];

        // Return the view that lists all vacatures, passing the vacatures data
        return view('auth.homepage', compact('vacatures', 'categories'));
    }

    public function solliciteer(Request $request, $vacatureId)
    {
        $user = Auth::user();
        $vacature = Vacature::findOrFail($vacatureId);
        $bedrijf = $vacature->bedrijf;

        // Vérifie si l'étudiant a déjà postulé
        if (Sollicitatie::where('user_id', $user->id)->where('vacature_id', $vacatureId)->exists()) {
            return back()->with('error', 'Je hebt al gesolliciteerd voor deze vacature.');
        }

        // Crée la sollicitation
        Sollicitatie::create([
            'user_id' => $user->id,
            'vacature_id' => $vacatureId,
        ]);

        // Crée le "mail"
        MailMessage::create([
            'sender_id' => $user->id,
            'receiver_id' => $bedrijf->id,
            'sender_role' => 'student',
            'receiver_role' => 'bedrijf',
            'subject' => 'Nieuwe sollicitatie: ' . $vacature->title,
            'body' => $user->name . ' heeft gesolliciteerd voor de vacature "' . $vacature->title . '".',
        ]);

        return redirect()->route('vacatures.index')->with('success', 'Sollicitatie verstuurd!');
    }
}
