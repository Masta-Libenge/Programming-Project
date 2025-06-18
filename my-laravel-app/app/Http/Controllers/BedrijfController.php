<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacature;

class BedrijfController extends Controller
{
    /**
     * Toon het dashboard voor bedrijven, inclusief hun vacatures en sollicitaties.
     */
   public function dashboard()
{
    $vacatures = Vacature::with(['applicants.profile']) // ← voeg .profile toe
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('bedrijf.bedrijfdashboard', compact('vacatures'));
}
}