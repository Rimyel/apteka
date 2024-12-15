<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Favorite;


class AccountController extends Controller
{
    // Функция для показа страницы account.blade.php
    public function showAccount()
    {
        $favoritesCount = Favorite::where('user_id', Auth::id())->count();
        // Получаем заказы текущего пользователя
        $orders = Order::where('user_id', auth()->id())->latest()->take(5)->get();

        return view('auth/account', compact('orders', 'favoritesCount' ));
    }
}
