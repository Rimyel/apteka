<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        try {
            // Валидация данных
            $validatedData = $request->validate([
                'name' => 'required|max:60|min:3|regex:/^[A-Za-zА-Яа-я0-9]+$/',
            ]);

            // Создание категории
            Brand::create($validatedData);

            // Успешное сообщение
            return redirect()->route('adminpanel')->with('message', 'Производитель успешно создан!')->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->route('adminpanel')->with('message', 'Ошибка при создании производителя: ' . $e->getMessage())->with('alert-type', 'error');
        }
    }
   
}
