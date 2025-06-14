<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sollicitatie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vacature_id'];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacature()
    {
        return $this->belongsTo(Vacature::class);
    }
}
