@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<!-- Личный кабинет -->
<div class="grid xl:grid-cols-3 lg:grid-cols-2 gap-y-4 mx-auto place-items-center items-start py-10">
    <!-- Блок персональная информация -->
    <div class="w-80 p-2 drop-shadow bg-white items-center justify-center">
        <div class="h-12 font-medium flex items-center border-b-2">
            <img src="{{ asset('img/sait/people.svg') }}" class="h-full pl-6 p-1 ">
            <p class="mx-auto font-bold">
                Персональная информация
            </p>
        </div>

        <!-- Блок личная информация -->

        <div class="grid grid-cols-2 text-center gap-4 p-4">
            <div class=" text-gray-500  ">Логин:</div>
            <div class="break-words w-full">{{ Auth::user()->name }}</div>
            <div class="text-gray-500  ">Email:</div>
            <p class="break-words w-full  ">{{ Auth::user()->email  }}</p>
        </div>
        <div class="flex justify-around">
            <form method="GET" action="{{ route('profile.edit') }}">
                @csrf
                <x-secondary-button>
                    Изменить
                </x-secondary-button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-secondary-button>
                    Выход
                </x-secondary-button>
            </form>
        </div>
    </div>

    <!-- Блок избранное -->

    <div class="w-80 drop-shadow bg-white items-center  justify-center">
        <div class="h-12 font-medium flex items-center border-b-2">
            <img src="{{ asset('img/sait/favorite_lk.svg') }}" class="h-full pl-6 p-1 ">
            <p class="mx-auto font-bold">
                Избранное
            </p>
        </div>
        <div class="p-4">
            <div class="text-gray-500 text-center p-4 ">
                У вас в избранном {{$favoritesCount}} товаров
            </div>
            <a href="{{ route('favorites.index') }}">
                <x-secondary-button>
                    Посмотреть
                </x-secondary-button>
            </a>
        </div>
    </div>

    <!-- Блок заказов -->

    <div class="w-80 drop-shadow bg-white items-center justify-center">
        <div class="h-12 font-medium flex items-center">
            <img src="{{ asset('img/sait/list.svg') }}" class="h-full pl-6 p-1 ">
            <p class="mx-auto font-bold">Заказы</p>
        </div>

        <!-- Заказы -->
        @if($orders->isEmpty())
            <div class="p-2 text-center text-gray-500">У вас нет заказов.</div>
        @else
            @foreach($orders as $order)
                <div class="p-2 rounded-br-2xl hover:bg-sky-100 flex flex-wrap">
                    <div class="text-sky-800 mx-1">Заказ №{{ $order->id }}</div>
                    <div class="text-gray-500">От {{ $order->created_at->format('d.m.Y H:i') }}</div>
                    <div class="mx-1">{{ number_format($order->total_price, 0) }} рублей.</div>
                    <div class="">{{ $order->status }}</div>
                </div>
            @endforeach
        @endif
        <a href="{{ route('orders.index') }}">
            <button class="justify-start bg-sky-400 p-2 m-2 text-white rounded-md">
                Подробнее
            </button>
        </a>
    </div>
</div>
@endsection