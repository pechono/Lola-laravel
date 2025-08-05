<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'apellido'=>'Consumidor Final',
            'nombre'=>'-',
            'telefono'=>'-',
            'activo'=>1,
            'dni'=>0,       
         ]);
    }
}
