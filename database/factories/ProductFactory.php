<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(), // Название товара
            'image_path' => $this->faker->imageUrl(), // Путь до картинки
            'price' => $this->faker->randomFloat(2, 1, 1000), // Цена товара (от 1 до 1000)
            'count' => $this->faker->numberBetween(1, 100), // Количество товара (от 1 до 100)
            'category_id' => \App\Models\Category::factory(), // Создание категории через фабрику
            'brand_id' => \App\Models\Brand::factory(), // Создание бренда через фабрику
            'AdministrationAndDosage' => $this->faker->text(), // Способ применения и дозы
            'indications' => $this->faker->text(), // Показания
            'composition' => $this->faker->text(), // Состав
            'contraindications' => $this->faker->text(), // Противопоказания
            'SpecialInstructions' => $this->faker->text(), // Особые указания
            'PackagingForm' => $this->faker->text(), // Упаковка и форма выпуска
            'SideEffects' => $this->faker->text(), // Побочные действия
            'TempStorage' => $this->faker->word(), // Температура хранения
            'SpecialStorage' => $this->faker->word(), // Особые условия хранения
            'shelf_life' => $this->faker->word(), // Сроки хранения
            'manufacturer' => $this->faker->word(), // Производитель
        ];
    }
}
