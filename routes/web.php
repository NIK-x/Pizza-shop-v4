<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});


Route::get('/favourites', function () {
    return view('favourites');
})->name('favourites');

