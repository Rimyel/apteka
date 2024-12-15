<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\isAdmin;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Основные маршруты
Route::get('/', [IndexController::class, 'index'])->name('index');
// Вывод страницы товара
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
//Вывод страницы поиска
Route::get('/search', [ResultController::class, 'search'])->name('search');


Route::get('/result/filter', [ResultController::class, 'filter'])->name('result.filter');

Route::get('/result', [ResultController::class, 'showResult'])->name('result');


// Для всех последующих нужна регистрация
Route::middleware(['auth'])->group(function () {
    // Личный кабинет
    Route::get('/account', [AccountController::class, 'showAccount'])->name('account');
    // Роуты для заказов
    Route::post('/ordersadd', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    // Роуты для избранного
    Route::post('/favorites/{id}', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'removeFromFavorites'])->name('favorites.remove');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    // Роуты для корзине
    Route::controller(CartController::class)->group(function () {
        //Добавить товар в корзину
        Route::post('/cart/add/{id}', 'add')->name('cart.add');
        // Вывод страницы корзины
        Route::get('/cart', 'index')->name('cart.index');
        //Увеличение количества товара
        Route::post('/cart/increase/{productId}', 'increase')->name('cart.increase');
        //Уменьшение количества товара
        Route::post('/cart/decrease/{productId}', 'decrease')->name('cart.decrease');
        //Обновление количества товара
        Route::post('/update-cart-quantity', [CartController::class, 'updateQuantity']);
        //Удалить товар из корзины
        Route::delete('/cart/remove/{productId}', 'remove')->name('cart.remove');
    });

    // Маршруты для профиля пользователя

    Route::prefix('profile')->group(function () {
        Route::controller(ProfileController::class)->group(function () {

            Route::get('/edit', 'edit')->name('profile.edit');
            Route::patch('/', 'update')->name('profile.update');

        });
    });
});
// Маршруты для AdminController с middleware isAdmin
Route::middleware(isAdmin::class)->group(function () {
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::patch('/admin/order/update-status', [OrderController::class, 'updateStatus'])->name('admin.order.update-status');

    Route::get('export-users', [AdminController::class, 'export'])->name('users.export');
    Route::prefix('product')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/', 'showProduct')->name('product');
            Route::get('/add', 'create')->name('product.create');
            Route::post('/', 'store')->name('product.store');
        });
    });

    Route::get('/admin', [AdminController::class, 'showAdmin'])->name('adminpanel');

});




// Маршруты для аутентификации через Yandex
Route::prefix('login/yandex')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'redirecttoyandex'])->name('yandex.login');
    Route::get('/redirect', [AuthenticatedSessionController::class, 'handleYandexCallback'])->name('yandex.callback');
});

// RESTful маршруты для Category и Brand контроллеров
Route::resource('categories', CategoryController::class)->only(['store']);
Route::resource('brands', BrandController::class)->only(['store']);



require __DIR__ . '/auth.php';
