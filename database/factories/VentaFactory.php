<?php

namespace Database\Factories;

use App\Models\Venta;
use App\Models\Operacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class VentaFactory extends Factory
{
    protected $model = Venta::class;

    public function definition()
    {
        return [
            'articulo_id' => $this->faker->numberBetween(1, 10), // Ajusta según los IDs disponibles en 'articulos'
            'cantidad' => $this->faker->randomFloat(2, 1, 100), // Cantidad vendida
            'operacion' => Operacion::factory(), // Crear una operación asociada
            'precioI' => $this->faker->randomFloat(2, 10, 100), // Precio inicial
            'precioF' => $this->faker->randomFloat(2, 10, 100), // Precio final
            'descuento' => $this->faker->randomFloat(2, 0, 0.5), // Porcentaje de descuento
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
