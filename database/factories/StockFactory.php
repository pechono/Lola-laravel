<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Articulo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'articulo_id' => Articulo::factory(), // Crea un artículo asociado
            'proveedor_id' =>1, // Ajusta según los IDs disponibles en 'proveedores'
            'stockMinimo' => $this->faker->numberBetween(1, 50), // Stock mínimo
            'stock' => $this->faker->randomFloat(2, 0, 100), // Stock actual
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
