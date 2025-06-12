<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacature;

class VacatureController extends Controller
{
    /**
     * Toon het formulier om een vacature aan te maken.
     */
    public function create()
    {
        return view('vacature.create');
    }

    /**
     * Sla een nieuwe vacature op in de database.
     */
    public function store(Request $request)
    {
       $request->validate([
    'title' => 'required|string|max:255',     // ✅ dit is correct
    'desc' => 'required|string',
    'type' => 'required|in:Stage,Werknemer',
    'color' => 'required|string'
]);

        Vacature::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'type' => $request->type,
            'color' => $request->color,
        ]);

        return redirect()->route('bedrijf.dashboard')->with('success', 'Vacature succesvol toegevoegd.');
    }
}
