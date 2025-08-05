<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Empresa::create([

            'empresa'=>'Bicicleteria Balsamo',
            'direccion'=>'Hipolito Yrigoyen',
            'telefono'=>' 3826 54-1085',
            'mail'=>'-'
        ]);
    }
}
