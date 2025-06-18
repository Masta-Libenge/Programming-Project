<?php

use App\Models\Stand;
use Illuminate\Support\Facades\Auth;

public function reserve($id)
{
    $stand = Stand::findOrFail($id);

    if ($stand->status === 'gereserveerd') {
        return back()->with('error', 'Deze stand is al gereserveerd.');
    }

    $stand->status = 'gereserveerd';
    $stand->bedrijf_id = Auth::id(); // of student afhankelijk van jouw login
    $stand->save();

    return back()->with('success', 'Je hebt deze stand succesvol gereserveerd.');
}

