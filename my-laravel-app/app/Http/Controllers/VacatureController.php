<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacature;

class VacatureController extends Controller
{
    /**
     * Toon het formulier om een vacature aan te maken.
     */
    public function create()
    {
        $vacatures = Vacature::latest()->take(5)->get(); // optioneel: toon laatste 5
        return view('vacature.create', compact('vacatures'));
    }

    /**
     * Sla een nieuwe vacature op.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc'  => 'required|string',
            'type'  => 'required|in:Stage,Werknemer',
            'color' => 'required|string'
        ]);

        Vacature::create([
            'title'    => $request->title,
            'desc'     => $request->desc,
            'type'     => $request->type,
            'color'    => $request->color,
            'user_id'  => Auth::id(), // koppeling met bedrijf
        ]);

        return redirect()
            ->route('bedrijf.dashboard')
            ->with('success', 'Vacature succesvol toegevoegd.');
    }
public function apply($id)
{
    $user = Auth::user();

    // Zorg dat enkel studenten kunnen solliciteren
    if (!$user || $user->type !== 'student') {
        return back()->with('error', 'Alleen studenten kunnen solliciteren.');
    }

    // Check of de student al gesolliciteerd heeft voor deze vacature
    if ($user->appliedVacatures()->where('vacature_id', $id)->exists()) {
        return back()->with('error', 'Je hebt al gesolliciteerd.');
    }

    // Voeg sollicitatie toe aan de pivot-tabel
    $user->appliedVacatures()->attach($id);

    return back()->with('success', 'Je hebt succesvol gesolliciteerd!');
}



}
