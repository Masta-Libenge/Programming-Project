<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'type',
        'sector',
        'location',
        'experience',
        'salary',
        'deadline',
        'color',
        'contract_duur',
        'contract_type',
        'werkrooster',
        'studies',
        'talenkennis',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class, 'vacature_student', 'vacature_id', 'student_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
