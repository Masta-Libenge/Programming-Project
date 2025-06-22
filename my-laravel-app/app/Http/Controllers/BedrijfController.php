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
    public function dashboard()
    {
        $vacatures = Vacature::with(['applicants.profile'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bedrijf.bedrijfdashboard', compact('vacatures'));
    }

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
