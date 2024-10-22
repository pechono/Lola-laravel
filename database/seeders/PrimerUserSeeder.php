<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PrimerUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com', // Cambia el email si lo necesitas
            'password' => Hash::make('VivaLaPatria'), // Cifra la contraseña antes de guardarla
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

