<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'bedrijf_id',
        'student_id',
        'date',
        'start_time',
        'end_time',
        'status'
    ];

    public function bedrijf()
    {
        return $this->belongsTo(User::class, 'bedrijf_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
