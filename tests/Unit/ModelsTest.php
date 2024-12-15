<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;


use App\Models\{User, Product, Category, Brand, Cart, Favorite};
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_belongs_to_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($product->category->is($category));
    }

    public function test_product_belongs_to_brand()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertTrue($product->brand->is($brand));
    }

    public function test_user_can_have_cart_items()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $cart = Cart::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->assertTrue($user->cart->contains($cart));
    }
}