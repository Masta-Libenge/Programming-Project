<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BedrijfSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Oscorp',
            'email' => 'NormanOsborn@gmail.com',
            'password' => Hash::make('goblin'),
            'role' => 'Bedrijf',
        ]);
    }
    /**
     * Run the database seeds.
     */

}
