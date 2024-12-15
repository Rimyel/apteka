<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $carts = [
            [
                'user_id' => 1, // Иван Иванов
                'product_id' => 1, // Парацетамол
                'quantity' => 2,
            ],
            [
                'user_id' => 1, // Иван Иванов
                'product_id' => 2, // Ибупрофен
                'quantity' => 1,
            ],
            [
                'user_id' => 2, // Хороший Админ
                'product_id' => 3, // Аспирин
                'quantity' => 3,
            ],
            [
                'user_id' => 2, // Хороший Админ
                'product_id' => 4, // Парацетамол для детей
                'quantity' => 1,
            ],
            [
                'user_id' => 3, // Сергей Сидоров
                'product_id' => 5, // Кетопрофен
                'quantity' => 2,
            ],
            [
                'user_id' => 3, // Сергей Сидоров
                'product_id' => 6, // Мелоксикам
                'quantity' => 1,
            ],
        ];

        DB::table('carts')->insert($carts);
    }
}
