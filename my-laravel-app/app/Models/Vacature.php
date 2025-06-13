<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacature extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'type', 'color'];

    public function bedrijf()
    {
        return $this->belongsTo(User::class, 'bedrijf_id');
    }

    public function sollicitanten()
    {
        return $this->belongsToMany(User::class, 'sollicitaties');
    }


}
