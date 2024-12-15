<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('layouts.header', function ($view) {
            $categories = Category::all(); // Получаем все категории
            $view->with('categories', $categories); // Передаем их в представление
        });
    }
}
