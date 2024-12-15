<div class="w-56 ">
<img src="{{ asset('storage/' . $imagePath) }}" class="rounded-lg w-56 h-56" alt="Product Image">
    <!-- Категория товара -->
    <p class="text-sky-500 mt-2 mb-2 text-sm">{{ $category }}</p>
    <!-- Название товара -->
    <p class="text-sky-800 mt-2 mb-6 font-bold">{{ $name }}</p>
    <!-- Цена товара -->
    <p class="text-sky-800 mt-2 mb-2 text-sm font-bold">{{ $price }}₽</p>
    <!-- Кнопка добавления в корзину -->
    <form action="{{ route('cart.add', $productId) }}" method="POST">
        @csrf
        <button type="submit"
            class="bg-sky-100 text-sky-800 rounded-xl w-full flex items-center font-bold h-10 justify-evenly gap-3 hover:bg-sky-200">
            <img src="{{ asset('img/sait/cart.svg') }}" alt="Cart Icon">
            <p>Добавить в корзину</p>
        </button>
    </form>
</div>