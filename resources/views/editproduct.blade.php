@extends('layouts.app')

@section('title', 'Обновление товара')



@section('content')
<form id="createProductForm" action="{{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
@method('PATCH')
  @csrf
  <div class="max-w-screen-lg mx-auto">
    <div class="flex flex-col space-y-4 my-4">
      <!-- Хлебний крошка -->


      <!-- Название товара -->
      <input name="name" value="{{ old('name', $product->name) }}"
        class="text-2xl w-full break-words xs:mx-auto sm:mx-0 text-gray-500 ring-0 border-0 focus:outline-none focus:ring-0 focus:border-0"
        placeholder="Название товара">


      <div class="grid xs:grid-cols-1 xs:gap-4 place-items-center sm:grid-cols-3 ">

        <!-- Блок с изображение -->
        <div class="relative inline-block hover:ring-2 p-4">
          <img id="imagePreview" src="{{ asset('storage/' . $product->image_path) }}" class="w-52 h-52 object-cover opacity-55"
            alt="Background Image">
          <input type="file" name="image_path" id="imageInput" accept="image/*" value="{{ old('image_path', $product->image_path) }}"
            class="absolute inset-0 w-full h-full opacity-0 bg-cursor-pointer cursor-pointer ">
        </div>
        <script>
          document.getElementById('imageInput').addEventListener('change', function (event) {
            const file = event.target.files[0]; // Get the first file
            if (file) {
              const reader = new FileReader(); // Create a FileReader object
              reader.onload = function (e) {
                const img = document.getElementById('imagePreview'); // Get the image element
                img.src = e.target.result; // Set the image source to the uploaded file
                img.className = "w-52 h-52 hover:ring-2"; // Update styles as needed
              };
              reader.readAsDataURL(file); // Read the file as a data URL
            }
          });
        </script>
        <input type="hidden" id="selected-category-id" name="category_id" value="{{ old('category_id', $product->category_id) }}">
        <input type="hidden" id="selected-manufacturer-id" name="brand_id" value="{{ old('brand_id', $product->brand_id) }}">
        <!-- Блок с текстом -->
        <div class="xs:justify-center">
          <div class="flex flex-col space-y-2 w-full">
            <div class="flex">

              <!-- Селектор категории -->
              <div class="space-x-2 items-center w-full flex relative justify-between">
                <p>Категория:</p>
                <div id="category-selector"
                  class="flex items-center justify-between border py-1 text-center rounded w-52 cursor-pointer"
                  onclick="toggleDropdown('category')">
                  <p class="flex-grow text-center">Выбрать категорию</p>
                  <img id="imagePreview" src="{{ asset('img/sait/select.svg') }}" alt="Background Image" class="mr-2">
                </div>

                <div id="dropdown-category"
                  class="absolute z-20 right-0 top-8 bg-white border hidden transition-max-height transition-min-height duration-300 ease-in-out overflow-hidden">
                  <input id="searchTerm-category" class="w-[206px] border border-solid border-gray-400  py-1"
                    type="text" placeholder="Поиск категорий" oninput="filterCategories('category')">
                  <div id="category-list"
                    class="min-h-0 transition-max-height transition-min-height max-h-64 duration-300 ease-in-out overflow-hidden">
                  </div>
                </div>
              </div>
            </div>
            <div>
              <!-- Селектор производителей -->
              <div class="space-x-2 items-center flex relative">
                <p>Производитель:</p>
                <div id="manufacturer-selector"
                  class="flex items-center justify-between border py-1 text-center rounded w-52 cursor-pointer"
                  onclick="toggleDropdown('manufacturer')">
                  <p class="flex-grow text-center">Выбрать производителя</p>
                  <img id="imagePreviewManufacturer" src="{{ asset('img/sait/select.svg') }}" alt="Background Image"
                    class="mr-2">
                </div>

                <div id="dropdown-manufacturer"
                  class="absolute z-10 right-0 top-8 bg-white border hidden transition-max-height transition-min-height duration-300 ease-in-out overflow-hidden">
                  <input id="searchTerm-manufacturer" class="w-[206px]  border border-solid border-gray-400 py-1"
                    type="text" placeholder="Поиск производителей" oninput="filterCategories('manufacturer')">
                  <div id="manufacturer-list"
                    class="min-h-0 transition-max-height transition-min-height max-h-64 duration-300 ease-in-out overflow-hidden">
                  </div>
                </div>
              </div>
            </div>

            <script>
              const allCategories = @json($categories);
              const allManufacturers = @json($brands);

              async function filterCategories(type) {
                const searchTerm = document.getElementById(`searchTerm-${type}`).value.toLowerCase();
                const filteredItems = type === 'category' ? allCategories : allManufacturers;

                const displayedItems = filteredItems.filter(item =>
                  item.name.toLowerCase().includes(searchTerm)
                ).slice(0, 5);

                const listId = type === 'category' ? 'category-list' : 'manufacturer-list';
                const listElement = document.getElementById(listId);
                listElement.innerHTML = ''; // Очищаем список

                displayedItems.forEach(item => {
                  const div = document.createElement('div');
                  div.innerHTML = `<label class="block hover:bg-sky-100 text-center cursor-pointer" onclick="selectItem('${type}', '${item.id}', '${item.name}')">${item.name}</label>`;
                  listElement.appendChild(div);
                });

                // Устанавливаем высоту на основе содержимого после добавления элементов
                if (displayedItems.length > 0) {
                  listElement.style.maxHeight = `${listElement.scrollHeight}px`; // Раскрываем
                  listElement.classList.remove('overflow-hidden'); // Убираем скрытие переполнения
                } else {
                  listElement.style.maxHeight = '0'; // Сжимаем, если нет элементов
                  listElement.classList.add('overflow-hidden'); // Скрываем переполнение
                }
              }

              function toggleDropdown(type) {
                const dropdownId = `dropdown-${type}`;
                const dropdown = document.getElementById(dropdownId);
                dropdown.classList.toggle('hidden');

                const listId = type === 'category' ? 'category-list' : 'manufacturer-list';
                const listElement = document.getElementById(listId);

                if (!dropdown.classList.contains('hidden')) {
                  if (listElement.children.length > 0) {
                    listElement.style.maxHeight = `${listElement.scrollHeight}px`; // Раскрываем
                    listElement.classList.remove('overflow-hidden'); // Убираем скрытие переполнения
                  } else {
                    listElement.style.maxHeight = '0'; // Сжимаем, если нет элементов
                    listElement.classList.add('overflow-hidden'); // Скрываем переполнение
                  }
                } else {
                  listElement.style.maxHeight = '0'; // Сжимаем при закрытии
                  listElement.classList.add('overflow-hidden'); // Скрываем переполнение
                }
              }

              function selectItem(type, id, name) {
                const selectorId = `${type}-selector`;
                document.getElementById(selectorId).querySelector('p').innerText = name;

                // Set the hidden input value based on selection
                if (type === 'category') {
                  document.getElementById('selected-category-id').value = id;
                } else if (type === 'manufacturer') {
                  document.getElementById('selected-manufacturer-id').value = id;
                }

                toggleDropdown(type);
              }
            </script>

            <div>
            Срок годности: <input class="ring-0 border-0 bg-opacity-0 focus:outline-none  focus:border-0">
            </div>
          </div>
        </div>
        <!-- Блок с корзиной -->
        <div class="w-hull flex flex-col justify-center">
          <div class="w-56 border-2 rounded-3xl">
            <div class="px-4 w-full h-11 flex justify-between items-center space-x-1 text-xl font-semibold">
              <input placeholder="Цена" name="price" value="{{ old('price', $product->price) }}"
                class="ring-0 border-0 bg-opacity-0 focus:outline-none focus:ring-0 focus:border-0 w-24">
              <p>₽</p>
            </div>
            <div class="w-full bg-sky-400 h-11 text-white flex justify-center items-center rounded-3xl">
              В корзину
            </div>
          </div>

          <div class="w-56 mt-2 flex h-11">
            <input class=" h-full w-full border border-gray-300 rounded-lg text-center" type="number" name="count" value="{{ old('count', $product->count) }}">
          </div>
          <div class="text-xl flex justify-center space-x-2 text-center w-full mt-4">
            <p>В наличии</p>
            <img src="{{ asset('img/sait/instock.svg') }}" alt="instock">
          </div>
        </div>
      </div>
      <div>
      <x-secondary-button class="fixed bottom-10 left-32 p-3" type="submit">Сохранить</x-secondary-button>
        <div class="text-lg font-semibold text-sky-600">
          Инструкция
        </div>
        <hr>
      </div>

      @component('components.editescription', [
  'sections' => $sections
])
      @endcomponent
    </div>
  </div>
  <style>
    html {
        scroll-behavior: smooth;
/* Плавная прокрутка */
          }
</style>
</form>
@endsection