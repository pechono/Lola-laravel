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
            'email' => 'balsamo2@hotmail.com', // Cambia el email si lo necesitas
            'password' => Hash::make('VivaLaPatria'), // Cifra la contraseña antes de guardarla
            'user_type' =>'Admin', // Guardar el user_type

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

