<!-- 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;

Route::get('/', [PizzaController::class, 'index'])->name('home');


Route::get('/api/pizzas', [PizzaController::class, 'index']);
Route::get('/api/ingredients', [PizzaController::class, 'getIngredients']);


Route::get('/favourites', function () {
    return view('favourites');
})->name('favourites'); -->


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavouriteController;

// Основные страницы
Route::get('/', [PizzaController::class, 'index'])->name('home');
Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites');

// API endpoints
Route::prefix('api')->group(function () {
    // Пиццы
    Route::get('/pizzas', [PizzaController::class, 'index']);
    Route::get('/pizzas/filter/{filter}', [PizzaController::class, 'filter']);
    
    // Ингредиенты
    Route::get('/ingredients', [PizzaController::class, 'getIngredients']);
    
    // Корзина
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'add']);
        Route::put('/update/{id}', [CartController::class, 'update']);
        Route::delete('/remove/{id}', [CartController::class, 'remove']);
        Route::delete('/clear', [CartController::class, 'clear']);
    });
    
    // Избранное
    Route::post('/favourites/toggle', [FavouriteController::class, 'toggle']);
    Route::get('/favourites', [FavouriteController::class, 'list']);
});