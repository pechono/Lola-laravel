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
            ProveedorSeeder::class
        ]);
        // User::factory(10)->create();

      /*   User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
