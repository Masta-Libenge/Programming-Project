<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['AULA1', 'AULA2', 'AULA3', 'AULA4'] as $aula) {
            for ($i = 1; $i <= 9; $i++) {
                DB::table('stands')->insert([
                    'aula' => $aula,
                    'nummer' => $i,
                    'status' => 'vrij',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
