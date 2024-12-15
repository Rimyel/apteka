@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="flex p-4 items-start">
  <div class="w-10/12 p-4">
    @if ($cartItems->isEmpty())
    <p class="w-96 h-96 flex items-center text-2xl">Ваша корзина пуста.</p>
  @else
  @foreach ($cartItems as $item)
    <x-cart-product :id="$item->product->id" :name="$item->product->name" :description="$item->product->indications"
    :price="$item->product->price" :imagePath="$item->product->image_path" :brand="$item->product->brand"
    :category="$item->product->category" :quantity="$item->quantity" :productId="$item->product_id"
    :maxQuantity="$item->product->count" />
  @endforeach
  <form id="order-form" action="{{ route('orders.store') }}" method="POST">
    @csrf
    @foreach ($cartItems as $index => $item)
    <!-- Скрытые поля для передачи данных о товарах -->
    <input type="hidden" name="products[{{ $index }}][id]" value="{{ $item->product->id }}">
    <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $item->quantity }}">
  @endforeach
    
  
@endif
  </div>
  <div class="w-2/12 rounded-lg border min-h-96 p-4 flex space-y-4 flex-col">
    <p>Количество товаров: <span id="total-quantity">{{ $cartItems->sum('quantity') }}</span></p>
    <p>Сумма товаров: <span id="total-price">{{ number_format($cartItems->sum(function ($item) {
  return $item->product->price * $item->quantity;
}), 2) }}</span> ₽</p>
    <hr>
    <button type="submit"
      class="w-full h-11 bg-sky-400 flex justify-center items-center rounded-lg text-white hover:bg-sky-500">
      Оформить заказ
    </button>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let totalQuantity = 0;
    let totalPrice = 0;

    function updateTotals() {
      document.getElementById('total-quantity').textContent = totalQuantity;
      document.getElementById('total-price').textContent = totalPrice.toFixed(2); 
    }

    document.querySelectorAll('.cart-product').forEach(function (cartProduct, index) {
      const quantityInput = cartProduct.querySelector('.quantity-input');
      const maxQuantity = parseInt(cartProduct.getAttribute('data-max-quantity'));
      const decreaseButton = cartProduct.querySelector('.decrease-button');
      const increaseButton = cartProduct.querySelector('.increase-button');
      const pricePerUnit = parseFloat(cartProduct.getAttribute('data-price'));
      const productId = cartProduct.getAttribute('data-product-id');

      // Найти скрытое поле для этого продукта
      const hiddenField = document.querySelector(`input[name="products[${index}][quantity]"]`);

      let currentQuantity = parseInt(quantityInput.value);
      totalQuantity += currentQuantity;
      totalPrice += currentQuantity * pricePerUnit;

      updateTotals();

      function updateQuantity(value) {
        if (value < 1) value = 1;
        else if (value > maxQuantity) value = maxQuantity;

        totalQuantity += (value - currentQuantity);
        totalPrice += (value - currentQuantity) * pricePerUnit;
        currentQuantity = value;

        quantityInput.value = currentQuantity;
        updateTotals();

        // Обновить скрытое поле
        if (hiddenField) {
          hiddenField.value = currentQuantity;
        }

        // Отправить обновленные данные на сервер
        saveQuantityToDatabase(productId, currentQuantity);
      }

      quantityInput.addEventListener('input', function () {
        const value = parseInt(quantityInput.value);
        if (isNaN(value) || value === 0) {
          quantityInput.value = currentQuantity;
        } else {
          updateQuantity(value);
        }
      });

      decreaseButton.addEventListener('click', function () {
        updateQuantity(currentQuantity - 1);
      });

      increaseButton.addEventListener('click', function () {
        updateQuantity(currentQuantity + 1);
      });
    });

    function saveQuantityToDatabase(productId, quantity) {
      fetch('/update-cart-quantity', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          product_id: productId,
          quantity: quantity
        })
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            console.log('Quantity updated successfully');
          } else {
            console.error('Failed to update quantity');
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  });
</script>













@endsection