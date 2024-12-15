<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Order; 
use Illuminate\Support\Facades\DB;

class OrdersChart
{
  protected $chart;

  public function __construct(LarapexChart $chart)
  {
    $this->chart = $chart;
  }

  public function build()
  {
    $orders = Order::select(DB::raw("COUNT(*) as count"), DB::raw("DATE(created_at) as date"))
      ->groupBy('date')
      ->pluck('count', 'date');

    return $this->chart->lineChart()
      ->setTitle('Статистика заказов')
      ->addData('Заказы', $orders->values()->toArray())
      ->setLabels($orders->keys()->toArray());
  }
}