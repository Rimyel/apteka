<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_path', 45); // Путь до картинкиs
            $table->decimal('price', 10, 0); // Цена товара
            $table->decimal('count', 10, 0);   // Количество товара

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            $table->text('AdministrationAndDosage')->nullable(); // Способ применения и дозы
            $table->text('indications')->nullable(); // Показания
            $table->text('composition')->nullable(); // Состав
            $table->text('contraindications')->nullable(); // Противопоказания
            $table->text('SpecialInstructions')->nullable(); // Особые указания
            $table->text('PackagingForm')->nullable(); // Упаковка и форма выпуска
            $table->text('SideEffects')->nullable(); // Побочные действия
            $table->string('TempStorage', 50)->nullable(); // Температура хранения
            $table->string('SpecialStorage')->nullable(); // Особые условия хранения
            $table->string('shelf_life', 50)->nullable(); // Сроки хранения
            $table->string('manufacturer')->nullable(); // Производитель

            $table->timestamps(); // Временные метки для created_at и updated_at

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');

    }
};
