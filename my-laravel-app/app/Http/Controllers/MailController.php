<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Affiche la boîte de réception avec des mails de test.
     */
    public function index()
    {
        // Mails fictifs pour test
        $mails = [
            [
                'id' => 1,
                'sender' => 'recruteur@technova.com',
                'subject' => 'Entretien pour un stage',
                'body' => "Bonjour,\n\nNous avons consulté votre profil et souhaiterions organiser un entretien.",
                'date' => '2025-06-10 09:00',
            ],
            [
                'id' => 2,
                'sender' => 'hr@greentech.be',
                'subject' => 'Confirmation de réception de candidature',
                'body' => "Merci pour votre candidature. Nous reviendrons vers vous prochainement.",
                'date' => '2025-06-09 15:30',
            ],
            [
                'id' => 3,
                'sender' => 'admin@hogeschool.be',
                'subject' => 'Rappel : Documents à remettre',
                'body' => "Veuillez transmettre vos documents avant le 15 juin pour finaliser votre inscription.",
                'date' => '2025-06-08 08:15',
            ],
        ];

        return view('student.mailbox', compact('mails'));
    }
}
