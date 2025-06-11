<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailMessage;
use Illuminate\Support\Facades\Auth;

class MailboxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->type ?? session('role');

        // Charger mails avec relations
        $mails = MailMessage::with('sender')
            ->where('receiver_id', $user->id)
            ->where('receiver_role', $role)
            ->latest()
            ->get();

        return view('student.mailbox', compact('mails', 'role'));
    }
}
