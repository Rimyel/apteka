<div class="h-auto p-5 space-x-9 border-b flex">
    <div>
        <img src="{{ asset('storage/' . $imagePath) }}" class="h-48 w-48 min-w-48" alt="Product Image">
    </div>
    <div class="space-y-4 flex flex-col w-full justify-between">
        <div class="text-lg">{{ $name }}</div>
        <div class="text-sm break-all">Производитель: {{ optional($brand)->name ?? 'Не указан' }}</div>
        <div class="text-sm break-all">Категория: {{ optional($category)->name ?? 'Не указана' }}</div>
        <div class="flex space-x-5">
            <form action="{{ route('cart.remove', $productId) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="h-9 w-9 bg-red-500 hover:bg-red-400 flex rounded-lg items-center">
                    <img src="{{ asset('img/sait/Essential.svg') }}" class="h-7 w-7 mx-auto" alt="trash">
                </button>
            </form>
        </div>
    </div>
    <div class="w-36 flex flex-col justify-between items-end">
        <div class="font-bold flex flex-col justify-between w-full items-end">
            <p>{{ number_format($price) }} ₽</p>
            <div class="font-xs flex space-x-1 font-normal">
                <p>В наличии</p>
                <img src="{{ asset('img/sait/in_stock.svg') }}" alt="In Stock">
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <div class="cart-product flex items-center space-x-2" data-max-quantity="{{ $maxQuantity }}"
                data-price="{{ $price }}" data-product-id="{{ $productId }}">
                <button type="button" class="h-8 w-8 bg-red-500 text-white rounded decrease-button">-</button>
                <input type="number" class="quantity-input w-16 text-center border border-gray-300 rounded"
                    value="{{ $quantity }}" min="1">
                <button type="button" class="h-8 w-8 bg-green-500 text-white rounded increase-button">+</button>
            </div>
        </div>
    </div>
</div>
