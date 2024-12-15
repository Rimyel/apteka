<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $cartProductIds = $cartItems->pluck('product_id')->toArray(); // 
        $sections = [
            [
                'id' => 'AdministrationAndDosage',
                'title' => 'Способ применения и дозы',
                'content' => $product->AdministrationAndDosage,
            ],
            [
                'id' => 'indications',
                'title' => 'Показания',
                'content' => $product->indications,
            ],
            [
                'id' => 'composition',
                'title' => 'Состав',
                'content' => $product->composition,
            ],
            [
                'id' => 'contraindications',
                'title' => 'Противопоказания',
                'content' => $product->contraindications,
            ],
            [
                'id' => 'SpecialInstructions',
                'title' => 'Особые указания',
                'content' => $product->SpecialInstructions,
            ],
            [
                'id' => 'PackagingForm',
                'title' => 'Упаковка и форма выпуска',
                'content' => $product->PackagingForm,
            ],
            [
                'id' => 'SideEffects',
                'title' => 'Побочные действия',
                'content' => $product->SideEffects,
            ],
            [
                'id' => 'TempStorage',
                'title' => 'Температура хранения',
                'content' => $product->TempStorage,
            ],
            [
                'id' => 'SpecialStorage',
                'title' => 'Особые условия хранения',
                'content' => $product->SpecialStorage,
            ],
        ];

        return view('product', compact('product', 'sections', 'cartProductIds'));
    }
    public function create()
    {
        $brands = Brand::All();
        $categories = Category::all();

        return view('addproduct', compact('categories', 'brands'));
    }
    public function store(Request $request)
    {
        try {
            // Валидация всех полей
            $validatedData = $request->validate([
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'nullable|string', // Validate as an image
                'price' => 'required|numeric|min:1',
                'count' => 'required|numeric|min:1',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'AdministrationAndDosage' => 'nullable|string',
                'indications' => 'nullable|string',
                'composition' => 'nullable|string',
                'contraindications' => 'nullable|string',
                'SpecialInstructions' => 'nullable|string',
                'PackagingForm' => 'nullable|string',
                'SideEffects' => 'nullable|string',
                'TempStorage' => 'nullable|string|max:100',
                'SpecialStorage' => 'nullable|string|max:100',
                'shelf_life' => 'nullable|string|max:100',
                'manufacturer' => 'nullable|string|max:100',
            ]);

            // Handle file upload
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');

                // Generate a unique filename
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                // Store the image in the public disk (storage/app/public/images)
                $path = $image->storeAs('images', $fileName, 'public');

                // Add the image path to validated data
                $validatedData['image_path'] = $path; // Store the path in validated data
            }

            // Сохранение товара в базе данных
            Product::create($validatedData);

            return redirect()->route('product.create')->with('message', 'Товар успешно создан!')->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->route('product.create')->with('message', 'Ошибка при создании товара: ' . $e->getMessage())->with('alert-type', 'error');
        }
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Получите все категории для выбора
        $brands = Brand::all(); // Получите все бренды для выбора

        // Создайте массив секций с проверками на существование свойств
        $sections = [
            [
                'id' => 'AdministrationAndDosage',
                'title' => 'Способ применения и дозы',
                'content' => $product->AdministrationAndDosage ?? '', // Используем оператор ?? для установки значения по умолчанию
            ],
            [
                'id' => 'indications',
                'title' => 'Показания',
                'content' => $product->indications ?? '',
            ],
            [
                'id' => 'composition',
                'title' => 'Состав',
                'content' => $product->composition ?? '',
            ],
            [
                'id' => 'contraindications',
                'title' => 'Противопоказания',
                'content' => $product->contraindications ?? '',
            ],
            [
                'id' => 'SpecialInstructions',
                'title' => 'Особые указания',
                'content' => $product->SpecialInstructions ?? '',
            ],
            [
                'id' => 'PackagingForm',
                'title' => 'Упаковка и форма выпуска',
                'content' => $product->PackagingForm ?? '',
            ],
            [
                'id' => 'SideEffects',
                'title' => 'Побочные действия',
                'content' => $product->SideEffects ?? '',
            ],
            [
                'id' => 'TempStorage',
                'title' => 'Температура хранения',
                'content' => $product->TempStorage ?? '',
            ],
            [
                'id' => 'SpecialStorage',
                'title' => 'Особые условия хранения',
                'content' => $product->SpecialStorage ?? '',
            ],
        ];

        return view('editproduct', compact('product', 'categories', 'brands', 'sections'));
    }
    public function update(Request $request, $id)
    {


        try {
            // Валидация всех полей
            $validatedData = $request->validate([
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'name' => 'nullable|string',
                'price' => 'nullable|numeric|min:1',
                'count' => 'nullable|numeric|min:1',
                'category_id' => 'nullable|exists:categories,id',
                'brand_id' => 'nullable|exists:brands,id',
                'AdministrationAndDosage' => 'nullable|string',
                'indications' => 'nullable|string',
                'composition' => 'nullable|string',
                'contraindications' => 'nullable|string',
                'SpecialInstructions' => 'nullable|string',
                'PackagingForm' => 'nullable|string',
                'SideEffects' => 'nullable|string',
                'TempStorage' => 'nullable|string|max:100',
                'SpecialStorage' => 'nullable|string|max:100',
                'shelf_life' => 'nullable|string|max:100',
                'manufacturer' => 'nullable|string|max:100',
            ]);

            // Обработка загрузки файла
            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');

                // Генерация уникального имени файла
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

                // Сохранение изображения в публичный диск (storage/app/public/images)
                $path = $image->storeAs('images', $fileName, 'public');

                // Добавление пути изображения в валидированные данные
                $validatedData['image_path'] = $path;
            }

            // Найдите продукт по ID
            $product = Product::findOrFail($id);

            // Обновление товара в базе данных
            $product->update($validatedData); // Используйте экземпляр модели для вызова update()

            return redirect()->route('product.edit', ['id' => $id])->with('message', 'Товар успешно обновлен!')->with('alert-type', 'success');
        } catch (\Exception $e) {
            // Обработка ошибок
            return redirect()->route('product.edit', ['id' => $id])->with('message', 'Ошибка при обновлении товара: ' . $e->getMessage())->with('alert-type', 'error');
        }
    }


}

