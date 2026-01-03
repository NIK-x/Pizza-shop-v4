<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;

Route::get('/', [PizzaController::class, 'index'])->name('home');


Route::get('/api/pizzas', [PizzaController::class, 'index']);
Route::get('/api/ingredients', [PizzaController::class, 'getIngredients']);


Route::get('/favourites', function () {
    return view('favourites');
})->name('favourites');