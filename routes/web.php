<?php

use App\Http\Controllers\ElementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/calculate-stock/{productId}', [ElementController::class, 'index']);
Route::get('/get-bundles', [ElementController::class, 'getBunldes']);

