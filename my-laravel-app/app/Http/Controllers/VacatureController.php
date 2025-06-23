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
     * Show the form to create a vacature.
     */
    public function create()
    {
        $vacatures = Vacature::latest()->take(5)->get();
        return view('vacature.create', compact('vacatures'));
    }

    /**
     * Store a new vacature.
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

    /**
     * Student applies to a vacature.
     */
    public function apply($id)
    {
        $user = Auth::user();

        if (!$user || $user->type !== 'student') {
            return back()->with('error', 'Alleen studenten kunnen solliciteren.');
        }

        if ($user->appliedVacatures()->where('vacature_id', $id)->exists()) {
            return back()->with('error', 'Je hebt al gesolliciteerd.');
        }

        // ✅ Attach with status
        $user->appliedVacatures()->attach($id, ['status' => 'pending']);

        return back()->with('success', 'Je hebt succesvol gesolliciteerd!');
    }

    /**
     * Student withdraws application.
     */
    public function unapply($id)
    {
        $user = auth()->user();
        $user->appliedVacatures()->detach($id);

        return redirect()->back()->with('success', 'Je sollicitatie werd ingetrokken.');
    }

    /**
     * Show a vacature.
     */
    public function show($id)
    {
        $vacature = Vacature::with('user')->findOrFail($id);
        return view('vacature.show', compact('vacature'));
    }

    /**
     * Accept an applicant for a vacature.
     */
    public function accept($vacatureId, $studentId)
    {
        $vacature = Vacature::findOrFail($vacatureId);

        if ($vacature->user_id !== Auth::id()) {
            abort(403);
        }

        // ✅ Update pivot status
        $vacature->applicants()->updateExistingPivot($studentId, ['status' => 'accepted']);

        $student = \App\Models\User::findOrFail($studentId);
        Mail::to($student->email)->send(new ApplicationAccepted($vacature));

        return back()->with('success', 'Sollicitatie geaccepteerd & mail verzonden.');
    }

    /**
     * Decline an applicant for a vacature.
     */
    public function decline($vacatureId, $studentId)
    {
        $vacature = Vacature::findOrFail($vacatureId);

        if ($vacature->user_id !== Auth::id()) {
            abort(403);
        }

        // ✅ Update pivot status
        $vacature->applicants()->updateExistingPivot($studentId, ['status' => 'declined']);

        return back()->with('success', 'Sollicitatie geweigerd.');
    }
}
