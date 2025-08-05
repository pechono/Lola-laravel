<?php

namespace Database\Seeders;

use App\Models\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unidad::create([

            'unidad'=>'unidad',
        ]);
        Unidad::create([
            'unidad'=>'Metro',
        ]);
        Unidad::create([
            'unidad'=>'Litro',
        ]);
        Unidad::create([
            'unidad'=>'MLitro',

        ]);
    }
}
