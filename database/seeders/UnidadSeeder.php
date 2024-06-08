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
            'unidad'=>'Kg',
        ]);
        Unidad::create([
            'unidad'=>'g',
        ]);
        Unidad::create([
            'unidad'=>'L',
        ]);
        Unidad::create([
            'unidad'=>'ml',
        ]);
        Unidad::create([
            'unidad'=>'Unds',
        ]);
        Unidad::create([
            'unidad'=>'M',
        ]);
        Unidad::create([
            'unidad'=>'cc',
        ]);
    }
}
