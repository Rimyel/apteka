<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Создаем пользователя через фабрику
            'total_price' => $this->faker->randomFloat(2, 10, 1000), // Генерация случайной цены между 10 и 1000
            'status' => $this->faker->randomElement(['В обработке', 'Завершен', 'Отменен']), // Случайный статус заказа
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
