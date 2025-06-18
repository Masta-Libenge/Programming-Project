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
    // Bijv. opslaan in pivot-tabel (als je een many-to-many gebruikt)
    // Auth::user()->appliedVacatures()->attach($id);

    return back()->with('success', 'Je hebt succesvol gesolliciteerd!');
}


}
