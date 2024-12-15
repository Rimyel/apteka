@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apteka52</title>
    @vite('resources/css/app.css')

<body class="bg-white mx-auto max-w-screen-xl">

    <div class="relative max-w-screen-xl mx-auto">
        <div class="carousel w-full xs:h-64 sm:h-[520px] rounded-lg overflow-hidden">
            <div class="carousel-item w-full h-full">
                <img src="{{ asset('img/banners/banners.jpg') }}" alt="Slide 1" class="w-full h-full object-cover">
            </div>
            <div class="carousel-item w-full h-full hidden">
                <img src="{{ asset('img/banners/i.webp') }}" alt="Slide 2" class="w-full h-full object-cover">
            </div>
            <div class="carousel-item w-full h-full hidden">
                <img src="{{ asset('img/banners/farma.jpg') }}" alt="Slide 2" class="w-full h-full object-cover">
            </div>
        </div>
        <!-- Стрелка назад  -->
        <button
            class="carousel-prev absolute top-1/2 left-4 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 focus:outline-none">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <!-- Стрелка вперёд  -->
        <button
            class="carousel-next absolute top-1/2 right-4 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 focus:outline-none">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Индикаторные точки слайдера -->
        <div class="flex justify-center space-x-2 mt-4">
            <span class="dot w-[6px] h-[6px] bg-gray-300 rounded-full cursor-pointer"></span>
            <span class="dot w-[6px] h-[6px] bg-gray-300 rounded-full cursor-pointer"></span>
            <span class="dot w-[6px] h-[6px] bg-gray-300 rounded-full cursor-pointer"></span>
        </div>
    </div>
    <!-- Категории  -->
    <div class="max-w-screen-lg mx-auto p-4">
        <h2 class="text-2xl font-bold text-center mb-6" id="allcategori">Категории</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <!-- Блок 1 -->
            <div class="relative rounded-lg shadow-md flex h-52 overflow-hidden p-4">
                <img src="{{ asset('img/sait/banner-back-product.svg') }}" alt="Background Image"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="relative z-10 w-6/12">
                    <div class="text-sky-800 font-bold">Лекарства</div>
                    <ul class="p-4 cursor-pointer break-words text-sky-800"
                        style="list-style-image: url({{ asset('img/sait/strel.svg') }})">
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 1]) }}">Анальгетик</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 2]) }}">БАДы</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 3]) }}">Жаропонижающие</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 4]) }}">Антибиотики</a>
                        </li>
                    </ul>
                </div>
                <div class="relative z-10 align-center w-6/12">
                    <img src="{{ asset('img/sait/bad.png') }}" alt="Background Image">
                </div>
            </div>

            <!-- Блок 2 -->
            <div class="relative rounded-lg shadow-md flex h-52 overflow-hidden p-4">
                <img src="{{ asset('img/sait/banner-back-product.svg') }}" alt="Background Image"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="relative z-10 w-6/12">
                    <div class="text-sky-800 font-bold">Первая помощь</div>
                    <ul class="text-sky-800 p-4 cursor-pointer"
                        style="list-style-image: url({{ asset('img/sait/strel.svg') }})">
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 5]) }}">Антисептики</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 6]) }}">Аптечки</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 7]) }}">Жгуты</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 8]) }}">Охлаждающие средства</a>
                        </li>
                    </ul>
                </div>
                <div class="relative z-10 align-center w-6/12">
                    <img src="{{ asset('img/sait/aptechka.png') }}" alt="Background Image">
                </div>
            </div>

            <!-- Блок 3 -->
            <div class="relative rounded-lg shadow-md flex h-52 overflow-hidden p-4">
                <img src="{{ asset('img/sait/banner-back-product.svg') }}" alt="Background Image"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="relative z-10 w-6/12">
                    <div class="text-sky-800 font-bold">Косметика</div>
                    <ul class="text-sky-800 p-4 cursor-pointer"
                        style="list-style-image: url({{ asset('img/sait/strel.svg') }})">
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 9]) }}">Маски для лица</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 10]) }}">Очищение и умывание</a>
                        </li>
                        <li class="hover:underline">
                            <a href="{{ route('result.filter', ['categories[]' => 11]) }}">Проблемная кожа</a>
                        </li>
                    </ul>
                </div>
                <div class="relative z-10 align-center w-6/12">
                    <img src="{{ asset('img/sait/kosm.png') }}" alt="Background Image">
                </div>
            </div>
        </div>
    </div> <!-- //Категории  -->



    <!-- Новинки  -->
    <div class="max-w-screen-lg mx-auto p-4">
        <h2 class="text-2xl font-bold text-center mb-6">Новинки</h2>
        <div class="max-w-screen-xl mx-auto justify-between items-center">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 place-items-center">

                @foreach($products as $product)
                    <x-index-card :image_path="$product->image_path" :category="$product->category->name"
                        :name="$product->name" :price="$product->price" :product-id="$product->id" />
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var carousel = document.querySelector('.carousel');
            var carouselItems = carousel.querySelectorAll('.carousel-item');
            var dots = document.querySelectorAll('.dot');
            var prevBtn = document.querySelector('.carousel-prev');
            var nextBtn = document.querySelector('.carousel-next');
            var currentIndex = 0;

            function showSlide(index) {
                carouselItems.forEach(function (item, i) {
                    item.classList.toggle('hidden', i !== index);
                    dots[i].classList.toggle('bg-blue-600', i === index); // Если точка активна
                    dots[i].classList.toggle('bg-gray-300', i !== index); // Сделать серым
                });
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                showSlide(currentIndex);
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % carouselItems.length;
                showSlide(currentIndex);
            }

            prevBtn.addEventListener('click', prevSlide);
            nextBtn.addEventListener('click', nextSlide);

            // менять слайд на клик
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentIndex = index;
                    showSlide(currentIndex);
                });
            });

            setInterval(nextSlide, 10000); // Каждые 10 сек менять слайд
        });
    </script>
</body>
@endsection

</html>