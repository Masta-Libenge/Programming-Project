<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Masta',
            'email' => 'masta@gmail.com',
            'password' => Hash::make('masta'),
            'role' => 'student',
        ]);
    }
}

