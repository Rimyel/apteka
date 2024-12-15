<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Создание категории
    public function store(Request $request)
    {
        try {
            // Валидация данных
            $validatedData = $request->validate([
                'name' => 'required|max:60|min:3|regex:/^[A-Za-zА-Яа-я0-9]+$/',
            ]);

            // Создание категории
            Category::create($validatedData);
            // Успешное сообщение
            return redirect()->route('adminpanel')->with('message', 'Категория успешно создана!')->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->route('adminpanel')->with('message', 'Ошибка при создании категории: ' . $e->getMessage())->with('alert-type', 'error');
        }
    }
    public function create()
    {
    
        $categories = Category::all();
        
        return view('result', compact('categories'));
    }
    
}
