<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Уникальный идентификатор записи в корзине
            
            // Идентификатор пользователя
            $table->unsignedBigInteger('user_id');
            
            // Идентификатор товара
            $table->unsignedBigInteger('product_id');
            
            // Количество товара в корзине
            $table->decimal('quantity', 10, 0); 
            
            // Временные метки для created_at и updated_at
            $table->timestamps(); 

            // Внешние ключи
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
