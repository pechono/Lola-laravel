<?php

namespace Database\Factories;

use App\Models\Operacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperacionFactory extends Factory
{
    protected $model = Operacion::class;

    public function definition()
    {
        return [
            'usuario_id' =>1 , // Ajusta según los IDs disponibles en 'usuarios'
            'venta' => $this->faker->randomFloat(2, 100, 5000), // Valor de la venta
            'tipoVenta_id' => $this->faker->numberBetween(1, 4), // Ajusta según los IDs disponibles en 'tipos de venta'
            'detalles' => $this->faker->sentence, // Detalles de la operación
            'cliente_id' => $this->faker->numberBetween(1, 10), // Ajusta según los IDs disponibles en 'clientes'
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
