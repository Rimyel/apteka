<?php

namespace Database\Factories;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(), // Генерация случайного названия бренда
            // Временные метки created_at и updated_at будут добавлены автоматически
        ];
    }
}