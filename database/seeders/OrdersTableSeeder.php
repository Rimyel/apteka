<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $orders = [];
        $userIds = [1, 2, 3]; // Идентификаторы пользователей

        foreach ($userIds as $userId) {
            for ($i = 0; $i < 100; $i++) { // Создаем по 3 заказа для каждого пользователя
                $orders[] = [
                    'user_id' => $userId,
                    'total_price' => rand(1000, 5000), // Случайная цена от 1000 до 5000
                    'status' => ['Завершен', 'В обработке', 'Отменен'][array_rand(['Завершен', 'В обработке', 'Отменен'])], // Случайный статус
                    'created_at' => Carbon::now()->subDays(rand(0, 30))->toDateTimeString(), // Случайная дата в пределах последних 30 дней
                    'updated_at' => Carbon::now()->subDays(rand(0, 30))->toDateTimeString(),
                ];
            }
        }

        DB::table('orders')->insert($orders);
    }
}

