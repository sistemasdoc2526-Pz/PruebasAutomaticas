<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_pagina_de_productos_carga(): void
    {
        $this->get('/productos')
            ->assertStatus(200)
            ->assertSee('Gestión de Productos');
    }

    public function test_muestra_mensaje_cuando_no_hay_productos(): void
    {
        $this->get('/productos')
            ->assertSee('No hay productos registrados.');
    }

    public function test_lista_los_productos_existentes(): void
    {
        Producto::factory()->create(['nombre' => 'Laptop Gamer']);

        $this->get('/productos')
            ->assertSee('Laptop Gamer');
    }

    public function test_puede_crear_un_producto(): void
    {
        $respuesta = $this->post('/productos', [
            'nombre' => 'Teclado',
            'precio' => 49.90,
            'stock'  => 10,
        ]);

        $respuesta->assertRedirect('/productos');
        $this->assertDatabaseHas('productos', ['nombre' => 'Teclado']);
    }

    public function test_el_nombre_es_obligatorio(): void
    {
        $this->post('/productos', [
            'nombre' => '',
            'precio' => 10,
            'stock'  => 5,
        ])->assertSessionHasErrors('nombre');

        $this->assertDatabaseCount('productos', 0);
    }

    public function test_el_precio_no_puede_ser_negativo(): void
    {
        $this->post('/productos', [
            'nombre' => 'Mouse',
            'precio' => -5,
            'stock'  => 5,
        ])->assertSessionHasErrors('precio');
    }

    public function test_puede_eliminar_un_producto(): void
    {
        $producto = Producto::factory()->create();

        $this->delete("/productos/{$producto->id}")
            ->assertRedirect('/productos');

        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
    }
}