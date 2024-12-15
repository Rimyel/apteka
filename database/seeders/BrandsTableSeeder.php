<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $brands = [
            ['name' => 'Pfizer'],
            ['name' => 'Johnson & Johnson'],
            ['name' => 'Bayer'],
            ['name' => 'Novartis'],
            ['name' => 'GlaxoSmithKline (GSK)'],
            ['name' => 'Roche'],
        ];

        DB::table('brands')->insert($brands);
    }
}
