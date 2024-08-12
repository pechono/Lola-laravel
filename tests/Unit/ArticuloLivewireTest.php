<?php

namespace Tests\Unit;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Unidad;
use App\Models\Proveedor;
use App\Models\Stock;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\Articulolivewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticuloLivewireTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_search_for_articles()
    {
        $categoria = Categoria::factory()->create();
        $unidad = Unidad::factory()->create();
        $proveedor = Proveedor::factory()->create();

        Articulo::factory()->create([
            'articulo' => 'Artículo de Prueba',
            'categoria_id' => $categoria->id,
            'unidad_id' => $unidad->id,
            'proveedor_id' => $proveedor->id,
        ]);

        Livewire::test(Articulolivewire::class)
            ->set('q', 'Artículo de Prueba')
            ->assertSee('Artículo de Prueba');
    }

    /** @test */
    public function it_can_sort_articles()
    {
        $categoria = Categoria::factory()->create();
        $unidad = Unidad::factory()->create();
        $proveedor = Proveedor::factory()->create();

        $articulo1 = Articulo::factory()->create(['articulo' => 'AAA']);
        $articulo2 = Articulo::factory()->create(['articulo' => 'ZZZ']);

        Livewire::test(Articulolivewire::class)
            ->call('sortby', 'articulo')
            ->assertSeeInOrder(['AAA', 'ZZZ']);

        Livewire::test(Articulolivewire::class)
            ->call('sortby', 'articulo')
            ->assertSeeInOrder(['ZZZ', 'AAA']);
    }

    /** @test */
    public function it_can_delete_an_article()
    {
        $articulo = Articulo::factory()->create();

        Livewire::test(Articulolivewire::class)
            ->call('confirmarArticuloDeletion', $articulo->id)
            ->call('deleteArticulo')
            ->assertDontSee($articulo->articulo);

        $this->assertFalse(Articulo::find($articulo->id)->activo);
    }

    // Otros tests como añadir y editar artículos pueden seguir una estructura similar...
}
