<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vacature;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BedrijfController extends Controller
{
    /**
     * Toon het dashboard van het bedrijf met zijn vacatures.
     */
    public function dashboard()
    {
        $vacatures = Vacature::with(['applicants.profile'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bedrijf.bedrijfdashboard', compact('vacatures'));
    }

    /**
     * Toon het profiel van het ingelogde bedrijf.
     */
    public function show()
    {
        $user = Auth::user(); // Ingelogde bedrijf gebruiker
        return view('bedrijf.bedrijfprofile', compact('user'));
    }

    /**
     * Update het profiel van het bedrijf.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefoon' => 'nullable|string|max:255',
            'adres' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->route('bedrijf.profile.show')->with('success', 'Profiel succesvol bijgewerkt.');
    }

    /**
     * Toon het planningsschema voor het bedrijf.
     * Genereert indien nodig tijdslots voor vandaag (behalve tijdens de middagpauze).
     */
    public function showPlanning()
    {
        $bedrijf = Auth::user(); 
        $today = Carbon::today()->toDateString();

        $alreadyExists = Reservation::where('bedrijf_id', $bedrijf->id)
            ->where('date', $today)
            ->exists();

        if (!$alreadyExists) {
            $start = Carbon::createFromTime(9, 0);
            $end = Carbon::createFromTime(17, 0);

            while ($start < $end) {
                // Sla de middagpauze tussen 12:30 en 13:30 over
                if ($start->between(Carbon::createFromTime(12, 30), Carbon::createFromTime(13, 30))) {
                    $start->addMinutes(5);
                    continue;
                }

                Reservation::create([
                    'bedrijf_id' => $bedrijf->id,
                    'date' => $today,
                    'start_time' => $start->format('H:i'),
                    'end_time' => $start->copy()->addMinutes(5)->format('H:i'),
                    'status' => 'free',
                ]);

                $start->addMinutes(5);
            }
        }

        return view('bedrijf.bedrijfplanning', compact('bedrijf'));
    }

    /**
     * Toon de reserveringen (afspraken) voor vandaag.
     */
    public function afspraken()
    {
        $bedrijf = Auth::user();
        $today = Carbon::today()->toDateString();

        $reservations = Reservation::with('student')
            ->where('bedrijf_id', $bedrijf->id)
            ->where('date', $today)
            ->where('status', 'reserved')
            ->orderBy('start_time')
            ->get()
            ->groupBy(function ($r) {
                return substr($r->start_time, 0, 2) . ':00';
            });

        return view('bedrijf.afspraken', compact('reservations'));
    }
}
