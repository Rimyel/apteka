<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Анальгетик'],
            ['name' => 'БАДы'],
            ['name' => 'Жаропонижающие'],
            ['name' => 'Антибиотики'],
            ['name' => 'Антисептики'],
            ['name' => 'Аптечки'],
            ['name' => 'Жгуты'],
            ['name' => 'Охлаждающие средства'],
            ['name' => 'Маски для лица'],
            ['name' => 'Очищение и умывание'],
            ['name' => 'Проблемная кожа'],
        ];

        DB::table('categories')->insert($categories);
    }
}
