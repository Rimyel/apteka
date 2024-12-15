<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
{
    // Получаем заказы текущего пользователя с пагинацией, сортируя по дате создания в порядке убывания
    $userOrders = Order::where('user_id', auth()->id())
                       ->orderBy('created_at', 'desc') // Сортировка по дате создания
                       ->paginate(5);

    // Проверяем, есть ли запрос на отображение конкретного заказа
    $selectedOrder = null;
    if ($request->has('order_id')) {
        $orderId = $request->input('order_id');
        // Получаем конкретный заказ с товарами
        $selectedOrder = Order::with('products')->find($orderId);
    }

    return view('order', compact('userOrders', 'selectedOrder'));
}

    public function show($id)
    {
        // Получаем конкретный заказ с товарами
        $selectedOrder = Order::with('products')->findOrFail($id);

        // Получаем заказы текущего пользователя для отображения списка
        $userOrders = Order::where('user_id', auth()->id())
                       ->orderBy('created_at', 'desc') // Сортировка по дате создания
                       ->paginate(5);

        return view('order', compact('userOrders', 'selectedOrder'));
    }

    public function store(Request $request)
    {
        try {
            // Валидация входящих данных
            $request->validate([
                'products' => 'required|array',
                'products.*.id' => 'required|exists:products,id',
                'products.*.quantity' => 'required|integer|min:1',
            ]);

            // Проверка наличия товаров на складе
            foreach ($request->products as $productData) {
                $product = Product::find($productData['id']);
                $quantity = (int) $productData['quantity'];

                // Проверяем, достаточно ли товара на складе
                if ($product->count < $quantity) {
                    throw new \Exception('Недостаточно товара на складе для продукта: ' . $product->name);
                }
            }

            // Создание нового заказа
            $order = new Order();
            $order->user_id = auth()->id();
            $order->status = 'в обработке'; // Установите статус по умолчанию
            $order->total_price = 0; // Изначально цена 0
            $order->save();

            // Обработка товаров в заказе
            foreach ($request->products as $productData) {
                $product = Product::find($productData['id']);
                $quantity = (int) $productData['quantity'];
                $price = $product->price;

                // Добавляем товар в промежуточную таблицу
                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                // Обновляем общую стоимость заказа
                $order->total_price += $price * $quantity;

                // Уменьшаем количество товара на складе
                $product->count -= $quantity;
                $product->save(); // Сохраняем изменения в базе данных
            }

            // Сохраняем обновленную общую стоимость заказа
            $order->save();

            // Очищаем корзину после успешного оформления заказа
            Cart::where('user_id', auth()->id())->delete();

            return redirect()->route('orders.index')->with('message', 'Заказ успешно создан!')->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->route('orders.index')->with('message', 'Ошибка при создании заказа: ' . $e->getMessage())->with('alert-type', 'error');
        }
    }
    public function updateStatus(Request $request)
    {
        try {
        // Валидация данных
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'order_status' => 'required|string|in:В обработке,Завершен,Отменен',
        ]);

        // Найти заказ по ID
        $order = Order::findOrFail($request->order_id);
        
        // Обновить статус заказа
        $order->status = $request->order_status;
        $order->save();

        return redirect()->route('adminpanel')->with('message', 'Статус заказа успешно обновлен!')->with('alert-type', 'success');
    } catch (\Exception $e) {
        // Обработка ошибок
        return redirect()->route('adminpanel')->with('message', 'Ошибка при изменении статуса заказа: ' . $e->getMessage())->with('alert-type', 'error');
    }
    }
}
