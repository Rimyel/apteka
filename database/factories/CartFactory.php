<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Создание пользователя через фабрику
            'product_id' => Product::factory(), // Создание продукта через фабрику
            'quantity' => $this->faker->numberBetween(1, 10), // Генерация случайного количества товара (от 1 до 10)
        ];
    }
}
