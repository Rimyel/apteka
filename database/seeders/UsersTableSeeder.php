<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Иван Иванов',
                'email' => 'ivan@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'Хороший Админ',
                'email' => 'admin@ru.com',
                'password' => bcrypt('admin@ru.com'),
                'role' => 'admin',
            ],
            [
                'name' => 'Сергей Сидоров',
                'email' => 'sergey@example.com',
                'password' => bcrypt('password123'),
                'role' => 'user',
            ],
        ];

        DB::table('users')->insert($users);
    }
}
