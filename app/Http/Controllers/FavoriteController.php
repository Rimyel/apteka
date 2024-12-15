<?php

namespace App\Http\Controllers;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function addToFavorites(Request $request, $productId)
    {
        // Проверяем, существует ли уже запись в избранном
        if (Favorite::where('user_id', Auth::id())->where('product_id', $productId)->exists()) {
            return redirect()->back()->with('message', 'Товар уже в избранном');
        }

        // Добавляем товар в избранное
        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return redirect()->back()->with('message', 'Товар добавлен в избранное');
    }

    public function removeFromFavorites($productId)
    {
        Favorite::where('user_id', Auth::id())->where('product_id', $productId)->delete();

        return redirect()->back()->with('message', 'Товар удален из избранного');
    }


    public function index()
    {
        // Получаем идентификаторы избранных товаров для текущего пользователя
        $favoriteIds = Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray();

        // Загружаем только те продукты, которые находятся в избранном
        $products = Product::with(['brand', 'category'])
            ->whereIn('id', $favoriteIds)
            ->get();

        // Подсчитываем количество избранных товаров
        $favoritesCount = $products->count();



        // Получаем идентификаторы избранных товаров для текущего пользователя
        $favorites = Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray();

        return view('favorites', compact('products', 'favorites', 'favoriteIds', 'favoritesCount'));
    }
}
