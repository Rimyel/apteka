<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apteka24</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    @php
        $links = [
            "Главная" => "index",
            "Купить по категориям" => "search",
            "Бренды" => "search"
        ];
    @endphp

<body class="bg-white mx-auto max-w-screen-xl">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <div class=" mx-auto flex justify-between items-center p-2">
        <div class=" grid-cols-2 space-x-4">
            <span>ИРКУТСК</span>
            <span>|</span>
            <span>Поддержка: 89241234567</span>
        </div>
        <div>
            @auth
                <a href="{{ route('account') }}" class="hover:text-sky-800">{{ Auth::user()->name }}</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-sky-800">Войти/Зарегистрироваться</a>
            @endauth
        </div>
    </div>

    <!-- Навигация -->
    <nav class=" sm:block xs:hidden shadow-lg">
        <div class="container mx-auto flex justify-between items-center p-4 align-middle">
            <div class=" flex items-center space-x-3">
                <img src="{{ asset('img/sait/hospital.svg') }}" alt="Apteka24 Logo" class="w-10 sm:hidden lg:block  ">
                <span class="text-xl font-bold text-sky-600">Apteka24</span>
            </div>
            </head>
            <div class=" flex justify-start lg:space-x-10 text-gray-700 lg:max-w-96 mx-auto sm:space-x-3 font-medium">
                @foreach ($links as $name => $link)
                    <a href="{{ route($link) }}" class="relative group hover:text-blue-600">
                        {{ $name }}
                        <span
                            class="absolute left-0 top-0 w-full h-[2px] bg-blue-600 scale-x-0 group-hover:scale-x-100 transition-transform duration-300 ease-in-out origin-center"></span>
                    </a>
                @endforeach
            </div>
            <div class="grid grid-cols-2 gap-5">
                <a href=" {{ route('cart.index') }} " class="relative group hover:text-blue-600">
                    <img class="h-5 w-5 mr-2" src="{{ asset('img/sait/cart.svg') }}" fill="none">
                </a>
                <a href=" {{ route('favorites.index') }} " class="relative group hover:text-blue-600">
                    <img class="h-5 w-5 mr-2" src="{{ asset('img/sait/favorite.svg') }}" fill="none">
                </a>
            </div>
        </div>
    </nav>

    <!-- Навигация для телефона -->
    <div class=" sm:hidden fixed bottom-0 left-0 right-0 text-white bg-white shadow-lg z-50">
        <div class=" w-full flex justify-between text-sky-800 items-center ">
            <div class="flex flex-col items-center justify-center h-full hover:bg-sky-100">
                <img src="{{ asset('img/sait/hospital.svg') }}" alt="Home" class="w-8 h-8">
                Главная
            </div>
            <div class="flex flex-col items-center justify-center h-full hover:bg-sky-100">
                <img src="{{ asset('img/sait/cart.svg') }}" alt="Cart" class="w-8  h-8">
                Корзина
            </div>
            <div class="flex flex-col items-center justify-center text-center h-full hover:bg-sky-100">
                <img src="{{ asset('img/sait/account.svg') }}" alt="Account" class="w-8  h-8">
                Профиль
            </div>
            <div class="flex flex-col items-center justify-center h-full hover:bg-sky-100">
                <img src="{{ asset('img/sait/favorite.svg') }}" alt="favorite" class="w-8  h-8">
                Избранное
            </div>
            <div class="flex flex-col items-center justify-center h-full hover:bg-sky-100">
                <img src="{{ asset('img/sait/category.svg') }}" alt="category" class="w-8  h-8">
                Каталог
            </div>
        </div>
    </div>
    <!-- Блок поиска и выбора категорий -->
    <form action="{{ route('search') }}" method="GET">
        <div class="flex items-center bg-gray-100 shadow-md px-4 py-2 ">

            <!-- Кнопка выбора категорий -->
            <div class="sm:block xs:hidden relative inline-block text-left">
                <div id="dropdownButton"
                    class="flex items-center text-sky-800 font-medium hover:bg-gray-200 px-3 py-2 rounded-full focus:outline-none">
                    <img class="h-5 w-5 mr-2" src="{{ asset('img/sait/category.svg') }}" fill="none">
                    Все категории
                </div>

                <!-- Выскакивающее меню -->
                <div id="dropdownMenu"
                    class="absolute right-50 max-h-56 z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 overflow-y-auto">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownButton">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('result.filter', ['categories[]' => $category->id]) }}"
                                    class="block px-4 py-2 hover:bg-sky-100">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <script>
                document.getElementById('dropdownButton').addEventListener('click', function () {
                    const dropdownMenu = document.getElementById('dropdownMenu');
                    dropdownMenu.classList.toggle('hidden');
                });

                window.addEventListener('click', function (event) {
                    const dropdownMenu = document.getElementById('dropdownMenu');
                    if (!event.target.closest('.relative')) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            </script>
            <!-- Поле ввода -->
            <input type="text" name="search" placeholder="Как будем лечиться?"
                class="flex-grow px-4 py-2 text-gray-700 rounded-tl-full rounded-bl-full border-none focus:outline-none bg-white" value="{{ request()->input('search', '') }}">

            <!-- Кнопка поиска -->
            <button
                class="bg-orange-500 border-orange-500 border-2 text-white p-2 rounded-tr-full rounded-br-full hover:bg-orange-600 focus:outline-none lg:max-w-96 mx-auto">
                <img src="{{ asset('img/sait/search.svg') }}" alt="Поиск" class="h-5 w-5">
            </button>
        </div>
    </form>
    <div id="notification"
        class="fixed bottom-4 right-4 hidden p-4 rounded shadow-lg transition-opacity duration-300 z-20
    @if(session('alert-type') === 'success') bg-green-500 text-white @elseif(session('alert-type') === 'error') bg-red-500 text-white @endif">
        @if(session('message'))
            {{ session('message') }}
        @endif
    </div>

    <!-- Кнопка администратора -->
    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('adminpanel') }}">
            <div class="fixed bottom-10 left-10 rounded-full hover:bg-sky-200 w-12 h-12">
                <img src="{{ asset('img/sait/administrator.svg') }}" alt="administrator" class="w-full h-full">
            </div>
        </a>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.getElementById('notification');

            // Проверяем, есть ли сообщение в сессии
            if (notification.innerText.trim() !== '') {
                // Убираем класс 'hidden', чтобы показать уведомление
                notification.classList.remove('hidden');

                //  Таймер на 10 секунд для скрытия уведомления
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 10000);
            }
        });
    </script>
    <style>
        ::-webkit-scrollbar-button {
            display: none;
            hidden
            /* Скрыть кнопки (стрелочки) */
        }

        body::-webkit-scrollbar {
            display: none;
            /* Убирает скроллбар в веб-кит браузерах */
        }
    </style>