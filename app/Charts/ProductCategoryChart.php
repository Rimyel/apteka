<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Category;

class ProductCategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        // Получаем данные о категориях и количестве продуктов в них
        $categories = Category::withCount('products')->get();

        // Извлекаем названия категорий и количество продуктов
        $labels = $categories->pluck('name')->toArray(); // Преобразуем в массив
        $data = $categories->pluck('products_count')->toArray(); // Преобразуем в массив

        return $this->chart->pieChart()
            ->setTitle('Количество товаров по категориям')
            ->addData($data) // Теперь это массив
            ->setLabels($labels); // Теперь это массив
    }
}