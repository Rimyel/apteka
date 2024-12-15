<?php

namespace App\Http\Controllers;
use App\Models\Product;


class IndexController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(4)->get(); // Последние 4 новинок
        return view('index', compact('products'));
    }
}
