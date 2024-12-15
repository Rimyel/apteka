@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="flex">
    <div class="flex">
        <div class="w-80 px-12 flex flex-col py-4 text-xl ">
            <div class="font-semibold">Товары</div>
            <a href="{{ route('product.create') }}">
                <x-menu-button button-id="createProductBtn" functionName="createProduct" label="Добавить"
                    icon="img/sait/add.svg" />
            </a>
            <div class="font-semibold">Категории</div>

            <x-menu-button button-id="addCategoryBtn" functionName="createCategory" label="Добавить"
                icon="img/sait/add.svg" />


            <div class="font-semibold">Бренд</div>

            <x-menu-button button-id="addBrandsBtn" functionName="createBrands" label="Добавить"
                icon="img/sait/add.svg" />

            <div class="font-semibold">Заказы</div>

            <x-menu-button button-id="OrderBtn" functionName="OrderStatus" label="Статус" icon="img/sait/add.svg" />



            <div class="font-semibold">Статистика</div>

            <x-menu-button button-id="StaticBtn" functionName="Static" label="Общая" icon="img/sait/add.svg" />
            <x-menu-button button-id="StaticOrderBtn" functionName="OrderStatic" label="Заказы"
                icon="img/sait/add.svg" />
            <x-menu-button button-id="StaticCategoryBtn" functionName="CategoryStatic" label="Категории"
                icon="img/sait/add.svg" />

            <div class="font-semibold">Отчёты</div>

            <x-menu-button button-id="ReportsBtn" functionName="Reports" label="Общие" icon="img/sait/add.svg" />





        </div>
    </div>

    <!-- Создание -->
    <div class="w-full p-4">
        <div id="createProduct" class="hidden space-y-4">
            <h2>Форма создания товара</h2>
            <!-- Поля формы для товара -->
        </div>

        <div id="createCategory" class="hidden w-52">
            <h2>Cоздание категории</h2>
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-4 flex flex-col">
                @csrf
                <x-text-input name="name" pattern="[A-Za-zА-Яа-я0-9]+"  title="Введите название без спец. символов. Максимальный размер имени 60 символов" placeholder="Категория"></x-text-input>
                <x-secondary-button type="submit" class="">Создать категорию</x-secondary-button>
            </form>
        </div>

        <div id="createBrands" class="hidden w-52">
            <h2>Cоздание производителя</h2>
            <form action="{{ route('brands.store') }}" method="POST" class="space-y-4 flex flex-col">
                @csrf
                <x-text-input name="name" pattern="[A-Za-zА-Яа-я0-9]+" title="Введите название без спец. символов. Максимальный размер имени 60 символов" placeholder="Производитель"></x-text-input>
                <x-secondary-button type="submit" class="">Создать производителя</x-secondary-button>

            </form>
        </div>
        <div id="OrderStatic" class="hidden w-10/12">
            <div>
                <div id="chart" style="max-width: 800px; margin: auto;"> {!! $ordersChart->container() !!}</div>

                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script src="{{ $ordersChart->cdn() }}"></script>
                {!! $ordersChart->script() !!}
            </div>
        </div>
        <div id="CategoryStatic" class="hidden w-10/12">
            <div>
                <div id="chart" style="max-width: 800px; margin: auto;"> {!! $productCategoryChart->container() !!}
                </div>

                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script src="{{ $productCategoryChart->cdn() }}"></script>
                {!! $productCategoryChart->script() !!}
            </div>
        </div>

        <div id="Static" class="hidden w-10/12">
            <div class=" flex">
                <div class="border w-36 flex flex-col items-center justify-between space-y-2 p-4">
                    <div class="text-xs">Количество зарегистрированных пользователей</div>
                    <p class="text-2xl">{{ $totalUsers }}</p>
                </div>

                <div class="border w-36 flex flex-col items-center  justify-between space-y-2 p-4">
                    <div class="text-xs">Общее количество заказов</div>
                    <p class="text-2xl">{{ $totalOrders }}</p>
                </div>

                <div class="border w-36 flex flex-col items-center  justify-between space-y-2 p-4">
                    <div class="text-xs">Средний чек заказа</div>
                    <p class="text-2xl">{{ number_format($averageOrderValue, 0) }} ₽</p>
                </div>

                <div class="border w-36 flex flex-col items-center  justify-between space-y-2 p-4">
                    <div class="text-xs">Процент брошенных корзин</div>
                    <p class="text-2xl">{{ number_format($abandonedCartsPercentage, 0) }}% </p>
                </div>

                <div class="border w-36 flex flex-col items-center   justify-between space-y-2 p-4">
                    <div class="text-xs">Конверсия</div>
                    <p class="text-2xl">{{ number_format($conversionRate, 0) }}%</p>
                </div>
            </div>
        </div>

        <div id="Reports" class="hidden w-10/12">
            <h1>Список пользователей</h1>
            <a href="{{ route('users.export') }}">
                <x-secondary-button class="mt-4" type="submit">Скачать список пользователей</x-secondary-button>
            </a>
        </div>
        <div id="OrderStatus" class="hidden w-10/12">
            <form action="{{ route('admin.order.update-status') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="w-20">
                    <label for="order_id">ID заказа:</label>
                    <x-text-input type="number" name="order_id" id="order_id" required class="form-control"/>
                </div>

                <div class="flex flex-col w-44">
                    <label for="order_status">Статус заказа:</label>
                    <select name="order_status" class="h-12 rounded-md outline border-2 border-sky-300 outline-none focus:ring-0 form-control" id="order_status" required 
                        <option value="">Выберите статус</option>
                        <option value="В обработке">В обработке</option>
                        <option value="Завершен">Завершен</option>
                        <option value="Отменен">Отменен</option>
                    </select>
                </div>

                <x-secondary-button class="mt-4" type="submit">Обновить статус заказа</x-secondary-button>
            </form>
        </div>
    </div>
</div>
<style>
    html {
        scroll-behavior: smooth;
        /* Плавная прокрутка */
    }
</style>

<script>
    function showDiv(divId) {
        // Получаем все блоки в контейнере с формами
        const divs = document.querySelectorAll('.w-full > div');

        // Скрываем все блоки
        divs.forEach(div => {
            div.style.display = 'none';
        });

        // Показываем только выбранный блок
        const selectedDiv = document.getElementById(divId);
        if (selectedDiv) {
            selectedDiv.style.display = 'block';
        }
    }
    function handleButtonClick(clickedId, divId) {
        
        const buttons = document.querySelectorAll('.menu-button');

        buttons.forEach(button => {
            button.classList.remove('bg-sky-100', 'border-sky-300', 'opacity-[0.9]', 'scale-[1.05]');
            button.classList.add('bg-white'); // Reset background color
        });


        const clickedButton = document.getElementById(clickedId);
        clickedButton.classList.remove('bg-white')
        clickedButton.classList.add('bg-sky-100', 'border-sky-300', 'opacity-[0.9]', 'scale-[1.05]');


        if (divId) {
            showDiv(divId);
        }
    }

</script>
@endsection