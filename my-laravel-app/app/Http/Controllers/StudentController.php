<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacature;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Je moet ingelogd zijn.');
        }

        $vacatures = Vacature::with('user')->latest()->get();
        $bedrijven = User::where('type', 'bedrijf')->get();

        return view('student.dashboard', compact('vacatures', 'bedrijven'));
    }

    public function planning()
    {
        $studentId = Auth::id();
        $today = now()->toDateString();

        $reservations = Reservation::with('bedrijf')
            ->where('student_id', $studentId)
            ->where('date', $today)
            ->get()
            ->groupBy(function ($reservation) {
                return substr($reservation->start_time, 0, 2) . ':00';
            });

        return view('student.planning', compact('reservations'));
    }
}
