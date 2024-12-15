<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Добавить товар в корзину
    public function add(Request $request, $productId)
    {
        $cart = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $productId],
            ['quantity' => \DB::raw('quantity + 1')]
        );

        return redirect()->back()->with('message', 'Товар добавлен в корзину!');
    }
// Удалить товар из корзину
    public function remove($productId)
    {
        Cart::where('user_id', auth()->id())->where('product_id', $productId)->delete();

        return redirect()->back()->with('message', 'Товар удален из корзины!');
    }
//Увеличить количество товара в корзине
    
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('cart', compact('cartItems', 'categories', 'brands'));
    }
    // Обновить количество товара асихронно используя JavaScript
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Найдите запись в корзине по product_id
        $cartItem = Cart::where('product_id', $productId)->first();

        if ($cartItem) {
            // Обновите количество товара
            $cartItem->quantity = $quantity;
            $cartItem->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Нету элементов в корзине']);
    }
}
