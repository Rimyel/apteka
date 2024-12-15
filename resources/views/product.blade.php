@extends('layouts.app')

@section('title', 'Товар')


@section('content')
<div class="max-w-screen-lg mx-auto">
  <div class="flex flex-col space-y-4 my-4">
    <!-- Хлебний крошка -->
    <div class="text-sm text-gray-500 max-xs:mx-auto MAX-sm:mx-0">
      <a href="{{ route('index') }}">Главная</a> /
      <a href="#">{{ $product->category->name }}</a> /
      {{ $product->name }}
    </div>

    <!-- Название товара -->
    <div class="text-2xl w-full break-words xs:mx-auto sm:mx-0 text-gray-500">
      {{ $product->name }}
    </div>

    <div class="flex md:justify-between xs:justify-center flex-wrap space-y-5   ">

      <!-- Блок с изображение -->
      <img src="{{ asset('storage/' . $product->image_path) }}" class="w-52 h-52 hover:ring-2 "
        alt="{{ $product->name }} Image">

      <!-- Блок с текстом -->
      <div class="xs:justify-center">
        <div class="flex flex-col space-y-2 w-full">
          <div class="flex items-center">
          </div>
          <div>
            Производитель: <x-link-product href="#bra">{{ $product->brand->name }}</x-link-product>
          </div>
          <div>
            Категория: <x-link-product href="#bra">{{ $product->category->name }}</x-link-product>
          </div>
          <div>
            Срок годности: {{ $product->shelf_life }}
          </div>
        </div>
      </div>
      <!-- Блок с корзиной -->

      <div class="flex flex-col space-y-4 justify-center">
        <div class="w-56 border-2 rounded-3xl">
          <div class="w-full h-11 flex justify-center items-center space-x-1 text-xl font-semibold">
            <p>{{ $product->price }}</p>
            <p>₽</p>
          </div>
          @if (in_array($product->id, $cartProductIds))
        <!-- Если товар уже в корзине -->
        <form action="{{ route('cart.index', $product->id) }}" method="POST">
        @csrf
        <button class="w-full bg-gray-400 h-11 text-white flex justify-center items-center rounded-3xl" disabled>
          В корзине
        </button>
        </form>
      @else
      <!-- Форма для добавления товара в корзину -->
      <form action="{{ route('cart.add', $product->id) }}" method="POST">
      @csrf
      <button type="submit"
        class="w-full bg-sky-400 h-11 text-white flex justify-center items-center rounded-3xl hover:bg-sky-500">
        В корзину
      </button>
      </form>
    @endif
        </div>
        @if ($product->count > 0)
      <div class="text-xl flex justify-center space-x-2 text-center w-full mt-4">
        <p>В наличии</p>
        <img src="{{ asset('img/sait/instock.svg') }}" alt="instock">
      </div>
    @endif

        <div class="w-56 flex flex-col space-y-2 items-center ">

          <div>
            Количество:
          </div>
          <div class="border rounded-lg py-2 px-4 text-xl">
            {{ $product->count }}
          </div>
        </div>

      </div>
    </div>
    <div>
      @if(auth()->check() && auth()->user()->role === 'admin')
      <a href="{{ route('product.edit', $product->id)}}">
        
        <x-secondary-button class="fixed bottom-10 left-32 p-3" type="submit">Отредактировать товар</x-secondary-button>
      </a>
    @endif

      <div class="text-lg font-semibold text-sky-600">
        Инструкция
      </div>
      <hr>
    </div>
    @component('components.description', [
  'sections' => $sections
])  @endcomponent
  </div>
</div>
<style>
  html {
    scroll-behavior: smooth;
    /* Плавная прокрутка */
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const textSections = document.querySelectorAll('.text-section');

    textSections.forEach(section => {
      const textContent = section.querySelector('.text-content');
      const toggleButton = section.querySelector('.toggle-button');

      // Устанавливаем максимальную длину для видимого текста
      const maxVisibleLength = 255; // Можно изменить по необходимости

      if (textContent.textContent.length > maxVisibleLength) {
        // Получаем видимую и скрытую части текста
        const visibleText = textContent.textContent.slice(0, maxVisibleLength) + ' ';
        const hiddenText = textContent.textContent.slice(maxVisibleLength);

        // Обновляем содержимое элемента
        textContent.innerHTML = `${visibleText}<span class="hidden">${hiddenText}</span>`;

        toggleButton.style.display = 'block'; // Показываем кнопку

        toggleButton.addEventListener('click', function () {
          const hiddenPart = textContent.querySelector('.hidden');
          if (hiddenPart.style.display === 'none' || hiddenPart.style.display === '') {
            hiddenPart.style.display = 'inline';
            toggleButton.textContent = 'Свернуть текст';
          } else {
            hiddenPart.style.display = 'none';
            toggleButton.textContent = 'Развернуть текст';
          }
        });
      } else {
        toggleButton.style.display = 'none'; // Скрываем кнопку, если текст короткий
      }
    });
  });
</script>
@endsection