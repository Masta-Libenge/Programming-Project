<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacature;
use App\Mail\ApplicationAccepted;
use Illuminate\Support\Facades\Mail;

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
        'title'         => 'required|string|max:255',
        'desc'          => 'required|string',
        'type'          => 'required|in:Stage,Werknemer,Freelance',
        'color'         => 'required|string',
        'sector'        => 'nullable|string|max:255',
        'location'      => 'nullable|string|max:255',
        'experience'    => 'nullable|string|max:255',
        'salary'        => 'nullable|string|max:255',
        'deadline'      => 'nullable|date',
        'contract_duur' => 'nullable|string|max:255',
        'contract_type' => 'nullable|string|max:255',
        'werkrooster'   => 'nullable|string|max:255',
        'studies'       => 'nullable|string|max:255',
        'talenkennis'   => 'nullable|string|max:255',
    ]);

    Vacature::create([
        'title'         => $request->title,
        'desc'          => $request->desc,
        'type'          => $request->type,
        'color'         => $request->color,
        'sector'        => $request->sector,
        'location'      => $request->location,
        'experience'    => $request->experience,
        'salary'        => $request->salary,
        'deadline'      => $request->deadline,
        'contract_duur' => $request->contract_duur,
        'contract_type' => $request->contract_type,
        'werkrooster'   => $request->werkrooster,
        'studies'       => $request->studies,
        'talenkennis'   => $request->talenkennis,
        'user_id'       => Auth::id(),
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

public function unapply($id)
{
    $user = auth()->user();
    $user->appliedVacatures()->detach($id);

    return redirect()->back()->with('success', 'Je sollicitatie werd ingetrokken.');
}


public function show($id)
{
    $vacature = Vacature::with('user')->findOrFail($id);
    return view('vacature.show', compact('vacature'));
}

/**
 * ✔️ Accept an applicant for a vacature.
 */
public function accept($vacatureId, $studentId)
{
    $vacature = Vacature::findOrFail($vacatureId);

    // Check if the logged-in bedrijf owns this vacature
    if ($vacature->user_id !== Auth::id()) {
        abort(403);
    }

    // Optional: add 'status' column to pivot or skip it and just send mail
    // Here: we just send mail & don't update a column if you don't have it
    $student = \App\Models\User::findOrFail($studentId);

    // Send email to student
    Mail::to($student->email)->send(new ApplicationAccepted($vacature));

    return back()->with('success', 'Sollicitatie geaccepteerd & mail verzonden.');
}

/**
 * ✔️ Decline an applicant for a vacature.
 */
public function decline($vacatureId, $studentId)
{
    $vacature = Vacature::findOrFail($vacatureId);

    if ($vacature->user_id !== Auth::id()) {
        abort(403);
    }

    // Just detach the student if you want
    $vacature->applicants()->detach($studentId);

    return back()->with('success', 'Sollicitatie geweigerd.');
}



}
