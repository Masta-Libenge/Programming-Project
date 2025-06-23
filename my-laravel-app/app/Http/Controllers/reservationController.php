<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bedrijf_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        $studentId = Auth::id();
        $bedrijfId = $request->bedrijf_id;

        $alreadyReserved = Reservation::where('bedrijf_id', $bedrijfId)
            ->where('student_id', $studentId)
            ->where('date', $request->date)
            ->exists();

        if ($alreadyReserved) {
            return response()->json(['error' => 'Je hebt al een reservatie bij dit bedrijf.'], 403);
        }

        $reservation = Reservation::where('bedrijf_id', $bedrijfId)
            ->where('date', $request->date)
            ->where('start_time', $request->start_time)
            ->first();

        if (!$reservation) {
            $reservation = Reservation::create([
                'bedrijf_id' => $bedrijfId,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'student_id' => $studentId,
                'status' => 'reserved',
            ]);
        } else {
            if ($reservation->status !== 'free') {
                return response()->json(['error' => 'Tijdslot is al gereserveerd.'], 409);
            }
            $reservation->update([
                'student_id' => $studentId,
                'status' => 'reserved',
            ]);
        }

        return response()->json(['message' => 'Reservatie bevestigd.']);
    }

    public function destroy($id)
    {
        $studentId = Auth::id();

        $reservation = Reservation::where('id', $id)
            ->where('student_id', $studentId)
            ->first();

        if (!$reservation) {
            return response()->json(['error' => 'Reservatie niet gevonden.'], 404);
        }

        $reservation->update([
            'student_id' => null,
            'status' => 'free',
        ]);

        return response()->json(['message' => 'Reservatie geannuleerd.']);
    }
}
