<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\{User, Product, Cart, Order};


class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order_with_valid_data()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['count' => 10]);
        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($user)->post(route('orders.store'), [
            'products' => [
                ['id' => $product->id, 'quantity' => 2],
            ],
        ]);

        $response->assertRedirect(route('orders.index'));
        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);
        $this->assertDatabaseHas('order_product', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $this->assertDatabaseMissing('carts', [
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'count' => 8, // 10 - 2
        ]);
    }

    public function test_create_order_fails_for_insufficient_stock()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['count' => 1]);
        Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response = $this->actingAs($user)->post(route('orders.store'), [
            'products' => [
                ['id' => $product->id, 'quantity' => 2],
            ],
        ]);

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('message', 'Ошибка при создании заказа: Недостаточно товара на складе для продукта: ' . $product->name);
    }
}