<?php

namespace App\Http\Controllers;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use App\Charts\ProductCategoryChart;
use App\Charts\OrdersChart;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminController extends Controller
{
    public function showAdmin()
    {
        // Создаем экземпляры графиков
        $ordersChart = new OrdersChart(new LarapexChart());
        $productCategoryChart = new ProductCategoryChart(new LarapexChart());

        // Строим графики
        $ordersChartData = $ordersChart->build();
        $productCategoryChartData = $productCategoryChart->build();

        // Получаем необходимые данные
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $averageOrderValue = Order::average('total_price');
        $abandonedCartsPercentage = $this->calculateAbandonedCarts();
        $conversionRate = $this->calculateConversionRate();

        // Возвращаем представление с данными и графиками
        return view('admin', [
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'averageOrderValue' => $averageOrderValue,
            'abandonedCartsPercentage' => $abandonedCartsPercentage,
            'conversionRate' => $conversionRate,
            'ordersChart' => $ordersChartData,
            'productCategoryChart' => $productCategoryChartData,
        ]);
    }
    private function calculateAbandonedCarts()
    {
        // Получаем количество пользователей, которые добавили товары в корзину
        $usersWithCarts = Cart::distinct('user_id')->count();

        // Получаем количество пользователей, которые завершили покупку
        $usersWithPurchases = Order::distinct('user_id')->count();

        // Рассчитываем процент брошенных корзин
        if ($usersWithCarts > 0) {
            $abandonedCarts = (1 - (( $usersWithPurchases) / ($usersWithCarts + $usersWithPurchases))) * 100;
        } else {
            $abandonedCarts = 0; // Если нет пользователей с корзинами
        }

        return $abandonedCarts;
    }
    private function calculateConversionRate()
    {
        // Получаем количество завершенных заказов
        $totalPurchases = Order::count();

        // Получаем количество уникальных пользователей
        $uniqueVisitors = User::distinct()->count('id');

        // Рассчитываем конверсию
        if ($uniqueVisitors > 0) {
            $conversionRate = ($totalPurchases / $uniqueVisitors) * 100;
        } else {
            $conversionRate = 0; // Если нет уникальных посетителей
        }

        return $conversionRate;
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx'); // Скачивание файла
    }
}
