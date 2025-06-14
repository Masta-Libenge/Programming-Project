<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Sollicitatie;
use Illuminate\Support\Facades\Auth;

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

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    public function getSenderNameAttribute()
    {
        if (!$this->sender) return 'Inconnu';
    
        if ($this->sender->type === 'student') {
            return $this->sender->firstname . ' ' . $this->sender->lastname;
        }
    
        if ($this->sender->type === 'bedrijf') {
            return $this->sender->company_name ?? $this->sender->name;
        }
    
        return $this->sender->name;
    }
    
    protected $appends = ['sender_name'];
}
