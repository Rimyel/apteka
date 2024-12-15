@extends('layouts.app')

@section('title', 'Поиск товаров')

@section('content')
<div class="flex p-4 items-start">
  <div class="w-3/12 rounded-lg border min-h-96 flex flex-col">
    <form method="GET" action="{{ route('result.filter') }}">
      <!-- Фильтр по категориям -->
      <x-dropdown-list header="Выберите категорию" :items="$categories->toArray()" />

      <!-- Фильтр по брендам -->
      <x-dropdown-list header="Выберите бренд" :items="$brands->toArray()" />

      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition">
        Применить
      </button>
    </form>
  </div>

  <div class="w-11/12 p-4">
    @if ($products->isEmpty()) <!-- Проверяем, пустая ли коллекция -->
        <div class="text-center text-gray-500 p-4">
            <p>Такого товара нет : (</p> <!-- Сообщение для пользователя -->
        </div>
    @else
        @foreach ($products as $product)
            <x-product-card :id="$product->id" :name="$product->name" :description="$product->indications"
              :price="$product->price" :imagePath="$product->image_path" :brand="$product->brand"
              :category="$product->category"
              :isFavorite="$favorites ? in_array($product->id, $favorites) : false"/> 
              
        @endforeach

        @if ($products->total() > 5) <!-- Проверяем общее количество товаров -->
            <div class="p-4">
                {{ $products->appends(request()->query())->links('pagination.search') }} <!-- Пагинация -->
            </div>
        @endif
    @endif
</div>

</div>

<style>
  @layer utilities {

    /* Полностью убираем кнопки у скроллбара */
    .no-scrollbar-buttons::-webkit-scrollbar {
      background-color: #f2f2f2;
      width: 8px;
    }

    .no-scrollbar-buttons::-webkit-scrollbar-thumb {
      background-color: #d9d9d9;
      color: #d9d9d9;
    }
  }

  .dropdown-content.open {
    max-height: 160px;
    /* Высота, достаточная для отображения первых 5 элементов */
    overflow-y: hidden;
  }

  .dropdown-content.full-open {
    max-height: 190px;

    ::-webkit-scrollbar-button {
      display: none;
      /* Скрыть кнопки (стрелочки) */
    }

    /* Высота для отображения до 8 элементов с прокруткой */
    overflow-y: auto;
  }

  .dropdown-content-wrapper {
    position: relative;
  }

  .dropdown-content {
    overflow-y: hidden;
    max-height: 0;
    transition: max-height 0.3s ease;
  }

</style>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Находим все контейнеры dropdown
    document.querySelectorAll('.dropdown-container').forEach(container => {
      const dropdownHeader = container.querySelector('.dropdown-header');
      const dropdownContent = container.querySelector('.dropdown-content');
      const showAllButton = container.querySelector('.show-all-button');
      const collapseButton = container.querySelector('.collapse-button');
      const applyButton = document.querySelector('form button[type="submit"]'); // Применить из формы
      const allItems = container.querySelectorAll('.dropdown-item');

      if (!dropdownHeader || !dropdownContent) {
        console.warn('Dropdown не имеет элементов:', container);
        return; // Если элементы отсутствуют, выходим из функции
      }

      const initialVisibleCount = 5;
      const maxVisibleCount = 8;
      const itemHeight = 32;
      const maxDropdownHeight = itemHeight * maxVisibleCount;
      const initialDropdownHeight = itemHeight * initialVisibleCount;

      function updateVisibility(isCollapsed) {
        const totalItems = allItems.length;
        const hasEnoughItems = totalItems >= initialVisibleCount + 1; 

        allItems.forEach((item, index) => {
          item.classList.toggle('hidden', isCollapsed && index >= initialVisibleCount);
          item.classList.toggle('flex', !isCollapsed || index < initialVisibleCount);
        });

        showAllButton?.classList.toggle('hidden', !isCollapsed || !hasEnoughItems);
        collapseButton?.classList.toggle('hidden', isCollapsed || !hasEnoughItems);
        dropdownContent.style.maxHeight = isCollapsed ? initialDropdownHeight + "px" : maxDropdownHeight + "px";
        dropdownContent.classList.toggle('full-open', !isCollapsed);
      }

      dropdownHeader.addEventListener('click', function () {
        if (dropdownContent.classList.contains('full-open')) {
          dropdownContent.classList.remove('open', 'full-open');
          dropdownContent.style.maxHeight = "0";
          showAllButton?.classList.add('hidden');
          collapseButton?.classList.add('hidden');
        } else if (dropdownContent.style.maxHeight === "0px" || !dropdownContent.classList.contains('open')) {
          updateVisibility(true);
          dropdownContent.classList.add('open');
          dropdownContent.style.maxHeight = initialDropdownHeight + "px";
        } else {
          showAllButton?.classList.add('hidden');
          dropdownContent.classList.remove('open');
          dropdownContent.style.maxHeight = "0";
        }
      });

      showAllButton?.addEventListener('click', function () {
        updateVisibility(false);
      });

      collapseButton?.addEventListener('click', function () {
        updateVisibility(true);
      });
    });

    // Обработка отправки формы
    applyButton?.addEventListener('click', function (event) {
      event.preventDefault(); // Отменяем стандартное поведение

      // Получаем выбранные категории и бренды
      const selectedCategories = Array.from(
        document.querySelectorAll('.dropdown-container input[name="categories[]"]:checked')
      ).map(input => input.value);

      const selectedBrands = Array.from(
        document.querySelectorAll('.dropdown-container input[name="brands[]"]:checked')
      ).map(input => input.value);

      // Отправляем выбранные данные
      filterProducts(selectedCategories, selectedBrands);
    });
  });

  // Функция фильтрации продуктов
  function filterProducts(selectedCategories, selectedBrands) {
    const url = new URL(window.location.href);
    url.searchParams.delete('categories[]'); // Удаляем старые параметры категорий
    url.searchParams.delete('brands[]');     // Удаляем старые параметры брендов

    selectedCategories.forEach(category => {
      url.searchParams.append('categories[]', category); // Добавляем новые категории
    });

    selectedBrands.forEach(brand => {
      url.searchParams.append('brands[]', brand); // Добавляем новые бренды
    });

    // Перезагрузка страницы с новыми параметрами
    window.location.href = url.toString();
  }

</script>








@endsection