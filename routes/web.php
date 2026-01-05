<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavouriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Главная страница (меню пицц)
Route::get('/', [PizzaController::class, 'index'])->name('home');

// Страница корзины
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// Страница избранного (синоним для корзины, если нужно сохранить старые ссылки)
Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites');

// API endpoints для асинхронных запросов
Route::prefix('api')->group(function () {
    
    // Маршруты для пицц
    Route::prefix('pizzas')->group(function () {
        Route::get('/', [PizzaController::class, 'index']); // Все пиццы
        Route::get('/filter/{filter}', [PizzaController::class, 'filter']); // Фильтрация пицц
    });
    
    // Маршруты для ингредиентов
    Route::get('/ingredients', [PizzaController::class, 'getIngredients']);
    
    // Маршруты для корзины
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'getCart']); // Получить содержимое корзины
        Route::post('/add', [CartController::class, 'add']); // Добавить в корзину
        Route::put('/update/{id}', [CartController::class, 'update']); // Обновить количество
        Route::delete('/remove/{id}', [CartController::class, 'remove']); // Удалить из корзины
        Route::delete('/clear', [CartController::class, 'clear']); // Очистить корзину
    });
    
    // Маршруты для избранного (если функционал избранного нужен отдельно от корзины)
    Route::prefix('favourites')->group(function () {
        Route::get('/', [FavouriteController::class, 'list']); // Список избранного
        Route::post('/toggle', [FavouriteController::class, 'toggle']); // Добавить/удалить из избранного
    });
});
