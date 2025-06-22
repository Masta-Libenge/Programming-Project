<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Vacature;

class ApplicationAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $vacature;

    /**
     * Create a new message instance.
     */
    public function __construct(Vacature $vacature)
    {
        $this->vacature = $vacature;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Je sollicitatie is geaccepteerd!')
                    ->view('emails.application_accepted')
                    ->with([
                        'vacature' => $this->vacature,
                    ]);
    }
}
