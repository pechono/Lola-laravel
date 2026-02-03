<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\TipoVenta;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
     public function run(): void
    {
        $this->call([
            EmpresaSeeder::class,
            TIpoPagoSeeder::class,
            UnidadSeeder::class,
            ClienteSeeder::class,
            ProveedorSeeder::class,
            CategoriaSeeder::class,
            PrimerUserSeeder::class,
            BicicletaCatalogoSeeder::class


        ]);


    }
    /*
    public function run()
    {     \App\Models\Articulo::factory(100)->create();
         \App\Models\Stock::factory(100)->create();

         \App\Models\Operacion::factory()
            ->has(\App\Models\Venta::factory()->count(3), 'ventas') // Crea 3 ventas por operación
            ->count(30) // Crea 5 operaciones
            ->create();
    }
    */
}
