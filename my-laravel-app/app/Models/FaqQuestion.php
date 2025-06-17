<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'question',
    ];

    // optioneel: relatie naar de gebruiker
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
