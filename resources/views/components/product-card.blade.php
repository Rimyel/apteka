<div class="h-auto p-5 space-x-9 border-b flex">
    <div>
        <img src="{{ asset('storage/' . $imagePath) }}" class="h-48 w-48 min-w-48" alt="Product Image">
    </div>
    <div class="space-y-4 flex flex-col w-full justify-around">
        <div class="text-lg">{{ $name }}</div>
        <div class="text-sm break-all">{{ $description }}</div>
        <div class="text-sm break-all">Производитель: {{ optional($brand)->name ?? 'Не указан' }}</div>
        <!-- Используем optional для безопасности -->
        <div class="text-sm break-all">Категория: {{ optional($category)->name ?? 'Не указана' }}</div>
        <!-- Используем optional для безопасности -->
    </div>
    <div class="w-36 flex flex-col space-y-4 justify-center items-end">
        <div class="font-bold flex flex-col justify-between w-full items-end">
            <p>{{ number_format($price, 2) }} ₽</p>
            <div class="font-xs flex space-x-1 font-normal">
                <p>В наличии</p>
                <img src="{{ asset('img/sait/in_stock.svg') }}" alt="In Stock">
            </div>
        </div>
        <button onclick="window.location.assign('{{ route('products.show', ['id' => $id]) }}')"
            class="rounded-lg flex p-4 space-x-1 text-white items-center text-center hover:bg-sky-400 bg-sky-500 w-32">
            <p class="mx-auto">Купить</p>
        </button>
        <!-- Форма для добавления/удаления из избранного -->
        @if($isFavorite)
            <form action="{{ route('favorites.remove', ['id' => $id]) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="rounded-lg flex p-2 space-x-1 text-white items-center bg-sky-600 hover:bg-sky-400 w-32">
                    <p>В избранном</p>
                    <img src="{{ asset('img/sait/favourites_result.svg') }}" alt="Favorites">
                </button>
            </form>
        @else
            <form action="{{ route('favorites.add', ['id' => $id]) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                    class="rounded-lg flex p-2 space-x-1 text-white justify-around items-center bg-red-500 hover:bg-red-400 w-32">
                    <p>Избранное</p>
                    <img src="{{ asset('img/sait/favourites_result.svg') }}" alt="Favorites">
                </button>
            </form>
        @endif
    </div>
</div>