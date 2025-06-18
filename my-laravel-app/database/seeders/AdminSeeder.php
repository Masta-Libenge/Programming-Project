<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Voeg admin enkel toe als hij nog niet bestaat
        if (!User::where('email', 'Admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'Admin@gmail.com',
                'password' => Hash::make('Admin123456'),
                'type' => 'Admin',
            ]);
        }
    }
}
