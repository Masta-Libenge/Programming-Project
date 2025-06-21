<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacature;
use App\Models\User;

class StudentController extends Controller
{
    public function dashboard()
    {
        $vacatures = Vacature::with('user')->latest()->get();
        $bedrijven = User::where('role', 'bedrijf')->get();

        return view('student.dashboard', compact('vacatures', 'bedrijven'));
    }
}
