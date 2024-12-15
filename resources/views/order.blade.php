@extends('layouts.app')

@section('content')


<div class="flex p-4 items-start">
  <div class="w-5/12 rounded-lg border min-h-96 p-4 flex space-y-4 flex-col">
    <div class="font-bold text-lg w-full">
      <p class="mx-auto text-center">Мои заказы</p>
    </div>
    <div class="  space-y-4">


      <div class="orders-list">
        @if($userOrders->isEmpty())
      <p>У вас нет заказов.</p>
    @else
    @foreach($userOrders as $order)
    <div class="order-item hover:bg-sky-100 p-4 flex justify-around"
      onclick="location.href='{{ route('orders.show', ['id' => $order->id]) }}'">

      <div>
      <p>Заказ #{{ $order->id }}</p>
      <p>Дата: {{ $order->created_at }}</p>
      </div>
      <p>Цена: {{ number_format($order->total_price, 0) }} руб.</p>
      <p> {{ $order->status }}</p>

    </div>
    <hr>
  @endforeach
    {{ $userOrders->links('pagination.pagination') }}
  @endif
      </div>
    </div>
  </div>
  <div class="w-7/12 px-4">
    <div class="border p-4">
      @if(isset($selectedOrder))
      <h1 class="text-lg font-semibold text-center mt-4 mb-6">Детали заказа #{{ $selectedOrder->id }}</h1>

      <div class="products-list">
      @if($selectedOrder->products->isEmpty())
      <p>Нет товаров в этом заказе.</p>
    @else
      @foreach($selectedOrder->products as $product)

      <div class="h-auto p-5 space-x-9 border-b flex">
        <div>
          <img src="{{ asset('storage/' . $product->image_path) }}" class="h-24 w-24 min-w-24" alt="Product Image">
        </div>
        <div class="space-y-4 flex flex-col w-full justify-between">
          <div class="text-lg">{{ $product->name }}</div>
        </div>
        <div class="w-36 flex flex-col justify-between items-end">
          <div class="font-bold flex flex-col justify-between w-full items-end">
            <p>{{ number_format($product->pivot->price, 0) }} ₽</p>
            <div class="text-sm flex space-x-1 font-normal">
            <p>Количество: {{ $product->pivot->quantity }}</p>
            </div>
          </div>
        </div>
      </div>
    @endforeach

      <!-- Если товаров больше 10, добавляется прокрутка -->
      @if(count($selectedOrder->products) > 10)
      {{ $selectedOrder->products->links('pagination.pagination') }}  
      @endif
    @endif
      </div>
    @else
      <h1>Детали заказа</h1>
      <p>Пожалуйста, выберите заказ, чтобы увидеть детали.</p>
    @endif
    </div>
  </div>
</div>
@endsection