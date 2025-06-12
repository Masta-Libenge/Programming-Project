<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BedrijfController extends Controller
{
    public function dashboard()
    {
        $students = User::where('type', 'student')->get();

        return view('bedrijf.dashboard', compact('students'));
    }
}
