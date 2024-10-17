<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(['categoria'=>'Oferta']);
        Categoria::create(['categoria'=>'Alimento Balanceado']);
        Categoria::create(['categoria'=>'Pañales']);
        Categoria::create(['categoria'=>'Higiene']);
        Categoria::create(['categoria'=>'Higiene Bebe']);
        Categoria::create(['categoria'=>'Higien Personal']);


    }
}
