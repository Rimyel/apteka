<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderProductTableSeeder extends Seeder
{
    public function run()
    {
        // Связываем товары с заказами (вручную)
        $orderProducts = [
            // Заказы пользователя Ивана Иванова (user_id = 1)
            [
                'order_id' => 1, // Заказ 1
                'product_id' => 1, // Парацетамол
                'quantity' => 2,
                'price' => 150.00,
            ],
            [
                'order_id' => 1, // Заказ 1
                'product_id' => 2, // Ибупрофен
                'quantity' => 1,
                'price' => 200.00,
            ],
            [
                'order_id' => 2, // Заказ 2
                'product_id' => 3, // Аспирин
                'quantity' => 3,
                'price' => 120.00,
            ],
            [
                'order_id' => 2, // Заказ 2
                'product_id' => 4, // Парацетамол для детей
                'quantity' => 1,
                'price' => 180.00,
            ],
            [
              'order_id'=>3, // Заказ 3 
              'product_id'=>5, // Кетопрофен 
              'quantity'=>2,
              'price'=>250.00 
             ],
             [
              'order_id'=>3, // Заказ 3 
              'product_id'=>6, // Мелоксикам 
              'quantity'=>1,
              'price'=>300.00 
             ],

             // Заказы пользователя Хорошего Админа (user_id = 2)
             [
                 'order_id'=>4, // Заказ 4 
                 'product_id'=>7, // БАД «Иммунал» 
                 'quantity'=>1,
                 'price'=>400.00 
             ],
             [
                 'order_id'=>4, // Заказ 4 
                 'product_id'=>8, // Витамин C 
                 'quantity'=>2,
                 'price'=>250.00 
             ],
             [
                 'order_id'=>5, // Заказ 5 
                 'product_id'=>9, // Омега-3 
                 'quantity'=>3,
                 'price'=>350.00 
             ],
             [
                 'order_id'=>5, // Заказ 5 
                 'product_id'=>10, // Жаропонижающее средство «Нурофен» 
                 'quantity'=>1,
                 'price'=>220.00 
             ],
             [
                 'order_id'=>6, // Заказ 6 
                 'product_id'=>11,// Антибиотик «Амоксициллин» 
                 'quantity'=>2,
                 'price'=>400.00 
             ],

             // Заказы пользователя Сергея Сидорова (user_id = 3)
             [
                 'order_id'=>7,// Заказ7  
                 'product_id'=>12,// Антисептик «Хлоргексидин» 
                 'quantity'=>1,
                 'price'=>150.00 
             ],
             [
               'order_id'=>8,// Заказ8  
               'product_id'=>9,// Парацетамол для детей  
               'quantity'=>2,
               'price'=>180.00  
             ],
             [
               'order_id'=>9,// Заказ9  
               'product_id'=>3,// Ибупрофен  
               'quantity'=>3,
               'price'=>200.00  
             ],
         ];

         DB::table('order_product')->insert($orderProducts);
     }
}
