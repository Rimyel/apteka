<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{User, Order};


class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_panel_displays_correct_data()
    {
        // Создаем пользователя с ролью 'admin'
        $admin = User::factory()->create(['role' => 'admin']);

        // Создаем 5 обычных пользователей
        User::factory()->count(5)->create(['role' => 'user']);

        // Создаем 3 заказа с общей стоимостью 100


        // Выполняем запрос к админ-панели как администратор
        $response = $this->actingAs($admin)->get(route('adminpanel'));

        // Проверяем статус ответа
        $response->assertStatus(200);

        // Проверяем, что переданы правильные данные в представление
        $response->assertViewHasAll([
            'totalUsers' => 6, // 5 обычных пользователей + 1 администратор

        ]);
    }
    public function test_admin_panel_displays_correct_order_data()
    {
        // Создаем администратора с ролью 'admin'
        $admin = User::factory()->create(['role' => 'admin']);

        // Создаем 3 заказа с общей стоимостью 100
        Order::factory()->count(3)->create(['total_price' => 100]);

        // Выполняем запрос к админ-панели как администратор
        $response = $this->actingAs($admin)->get(route('adminpanel'));

        // Проверяем статус ответа
        $response->assertStatus(200);

        // Проверяем, что переданы правильные данные в представление
        $response->assertViewHas('totalOrders', 3);
        $response->assertViewHas('averageOrderValue', 100);
    }

    public function test_admin_panel_requires_admin_authentication()
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('adminpanel'));

        $response->assertRedirect(route('index'));
    }
}