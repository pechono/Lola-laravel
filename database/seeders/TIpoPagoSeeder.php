<?php

namespace Database\Seeders;

use App\Models\TipoVenta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TIpoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoVenta::create([
            'tipoVenta'=>'Contado Efectivo'
        ]);
        TipoVenta::create([
            'tipoVenta'=>'Contado Debito'
        ]);
        TipoVenta::create([
            'tipoVenta'=>'Tarjeta'
        ]);
        TipoVenta::create([
            'tipoVenta'=>'Cuenta Corriente'
        ]);
    }
}
