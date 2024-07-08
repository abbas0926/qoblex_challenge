<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


Route::get('/calculate-stock/{productId}', [StockController::class, 'calculateStock']);