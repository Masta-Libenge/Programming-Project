<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailMessage extends Model
{
    use HasFactory;

    protected $table = 'mails';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sender_role',
        'receiver_role',
        'subject',
        'body',
    ];

    // Ajout pour exposer sender_name dans le JSON
    protected $appends = ['sender_name'];

    // Relation vers l'étudiant si sender_role = 'student'
    public function senderStudent()
    {
        return $this->belongsTo(User::class, 'sender_id')->where('type', 'student');
    }

    // Relation vers l'entreprise si sender_role = 'bedrijf'
    public function senderBedrijf()
    {
        return $this->belongsTo(User::class, 'sender_id')->where('type', 'bedrijf');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getSenderNameAttribute()
    {
        if (!$this->sender) {
            return 'Inconnu';
        }

        if ($this->sender_role === 'student' && $this->sender->type === 'student') {
            return $this->sender->firstname . ' ' . $this->sender->lastname;
        } elseif ($this->sender_role === 'bedrijf' && $this->sender->type === 'bedrijf') {
            return $this->sender->company_name; // ou name selon ta base
        }

        return 'Inconnu';
    }
}
