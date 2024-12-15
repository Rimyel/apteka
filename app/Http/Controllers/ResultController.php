<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    // Универсальный метод для подготовки данных
    private function prepareData($selectedCategories = [], $selectedBrands = [], $searchQuery = null)
    {
        // Получаем идентификаторы избранных товаров для текущего пользователя
        $favorites = Favorite::where('user_id', Auth::id())->pluck('product_id')->toArray();

        // Загружаем продукты с фильтрацией по категориям, брендам и поисковым запросам
        $products = Product::with(['brand', 'category'])
            ->when($selectedCategories, function ($query) use ($selectedCategories) {
                $query->whereIn('category_id', $selectedCategories);
            })
            ->when($selectedBrands, function ($query) use ($selectedBrands) {
                $query->whereIn('brand_id', $selectedBrands);
            })
            ->when($searchQuery, function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            })
            ->paginate(5);

        // Преобразуем категории в нужный формат
        $categories = Category::all()->map(function ($category) use ($selectedCategories) {
            return [
                'id' => 'category_' . $category->id,
                'label' => $category->name,
                'checked' => in_array($category->id, $selectedCategories),
            ];
        });

        // Преобразуем бренды в нужный формат
        $brands = Brand::all()->map(function ($brand) use ($selectedBrands) {
            return [
                'id' => 'brand_' . $brand->id,
                'label' => $brand->name,
                'checked' => in_array($brand->id, $selectedBrands),
            ];
        });

        return compact('categories', 'brands', 'products', 'favorites'); // Добавляем избранное в возвращаемые данные
    }

    public function showResult(Request $request)
    {
        // Получаем выбранные категории и бренды из запроса
        $selectedCategories = $request->input('categories', []);
        $selectedBrands = $request->input('brands', []);
        
        // Подготавливаем данные с учетом выбранных категорий и брендов
        $data = $this->prepareData($selectedCategories, $selectedBrands);
        return view('result', $data);
    }

    public function search(Request $request)
    {
        // Получаем поисковый запрос
        $searchQuery = $request->input('search');
        
        // Получаем выбранные категории и бренды из запроса
        $selectedCategories = $request->input('categories', []);
        $selectedBrands = $request->input('brands', []);
        
        // Подготавливаем данные с учетом выбранных категорий, брендов и поискового запроса
        $data = $this->prepareData($selectedCategories, $selectedBrands, $searchQuery);
        return view('result', $data);
    }

    public function filter(Request $request)
    {
        // Получаем выбранные категории и бренды из запроса
        $selectedCategories = $request->input('categories', []);
        $selectedBrands = $request->input('brands', []);
        
        // Подготавливаем данные с учетом выбранных категорий и брендов
        $data = $this->prepareData($selectedCategories, $selectedBrands);
        return view('result', $data);
    }
}
