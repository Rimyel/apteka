<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// API для поиска категорий

Route::get('/brands', [BrandController::class, 'search'])->name('brands.search');
