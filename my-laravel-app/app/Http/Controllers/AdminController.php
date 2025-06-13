<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vacature;

class AdminController extends Controller
{
    // Admin dashboard
    public function index()
    {
        $users = User::all();
        $vacatures = Vacature::all();

        return view('admin.dashboard', compact('users', 'vacatures'));
    }

    // Gebruiker verwijderen
public function destroyUser($id)
{
    // Verwijder jezelf niet
    if (auth()->id() == $id) {
        return redirect()->route('admin.dashboard')->with('error', 'Je kunt jezelf niet verwijderen.');
    }

    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Gebruiker succesvol verwijderd.');
}

   

    // Vacature verwijderen
    public function destroyVacature($id)
    {
        $vacature = Vacature::findOrFail($id);
        $vacature->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Vacature succesvol verwijderd.');
    }
}
