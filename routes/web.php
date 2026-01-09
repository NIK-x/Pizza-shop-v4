<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavouriteController;

Route::get('/', [PizzaController::class, 'index'])->name('home');


Route::get('/cart', [CartController::class, 'index'])->name('cart');


Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites');


Route::prefix('api')->group(function () {
    
  
    Route::prefix('pizzas')->group(function () {
        Route::get('/', [PizzaController::class, 'index']);
        Route::get('/filter/{filter}', [PizzaController::class, 'filter']); 
    });
    

    Route::get('/ingredients', [PizzaController::class, 'getIngredients']);
    

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'getCart']); 
        Route::post('/add', [CartController::class, 'add']); 
        Route::put('/update/{id}', [CartController::class, 'update']); 
        Route::delete('/remove/{id}', [CartController::class, 'remove']); 
        Route::delete('/clear', [CartController::class, 'clear']); 
    });
    

    Route::prefix('favourites')->group(function () {
        Route::get('/', [FavouriteController::class, 'list']); 
        Route::post('/toggle', [FavouriteController::class, 'toggle']);
    });
});
