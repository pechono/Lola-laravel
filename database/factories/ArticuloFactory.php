<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'articulo' => $this->faker->company,
            'categoria_id' => $this->faker->numberBetween(1, 3), // Ajusta según los IDs disponibles en 'categorias'
            'presentacion' => $this->faker->randomElement(['Bolsa', 'Caja', 'Saco']),
            'unidad_id' => $this->faker->numberBetween(1, 7), // Ajusta según los IDs disponibles en 'unidades'
            'descuento' => $this->faker->randomFloat(2, 0, 0.5), // Porcentaje de descuento
            'unidadVenta' => $this->faker->randomElement(['Kilo', 'Litro', 'Unidad']),
            'precioI' => $this->faker->randomFloat(2, 10, 100), // Precio inicial
            'precioF' => $this->faker->randomFloat(2, 10, 100), // Precio final
            'caducidad' => $this->faker->date('Y-m-d', '+1 year'), // Fecha en el futuro
            'detalles' => $this->faker->sentence,
            'suelto' => $this->faker->boolean,
            'activo' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
