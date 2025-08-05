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

        Categoria::create(['categoria'=>'Camara']);
        Categoria::create(['categoria'=>'Cubierta']);
        Categoria::create(['categoria'=>'Rueda']);
        Categoria::create(['categoria'=>'Trasmicion']);
        Categoria::create(['categoria'=>'Formas']);



    }
}
