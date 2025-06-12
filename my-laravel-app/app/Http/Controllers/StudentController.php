<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacature;

class StudentController extends Controller
{
    /**
     * Toon het dashboard voor studenten.
     */
    public function dashboard()
    {
        // Haal alle vacatures op
        $vacatures = Vacature::all();

        // Geef ze door aan de view
        return view('student.dashboard', compact('vacatures'));
    }
}
