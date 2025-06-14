<?php
namespace App\Http\Controllers;

use App\Models\Sollicitatie;
use App\Models\Vacature;
use App\Models\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SollicitatieController extends Controller
{
    public function store(Request $request, $vacatureId)
    {
        $user = Auth::user();

        // Créer la sollicitation
        Sollicitatie::create([
            'user_id' => $user->id,
            'vacature_id' => $vacatureId,
        ]);

        // Créer le mail automatique
        $vacature = Vacature::with('bedrijf')->findOrFail($vacatureId);
        $bedrijf = $vacature->bedrijf;

        MailMessage::create([
            'sender_id' => $user->id,
            'receiver_id' => $bedrijf->id,
            'sender_role' => 'student',
            'receiver_role' => 'bedrijf',
            'subject' => 'Nieuwe sollicitatie voor vacature: ' . $vacature->title,
            'body' => $user->name . ' heeft gesolliciteerd voor de vacature "' . $vacature->title . '".',
        ]);

        return redirect()->back()->with('success', 'Sollicitatie verzonden!');
    }
}