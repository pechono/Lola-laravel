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
// <<<<<<< HEAD
//             'empresa'=>'Forrajeria Lola',
//             'direccion'=>'Majul Ayan 280',
//             'telefono'=>' 3826 54-0417',
// =======
            'empresa'=>'Bicicleteria Balsamo',
            'direccion'=>'Hipolito Yrigoyen',
            'telefono'=>' 3826 54-1085',
            'mail'=>'-'
        ]);
    }
}
