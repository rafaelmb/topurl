<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [\App\Http\Controllers\ProductController::class, 'showProducts']);

Route::get('/top', [\App\Http\Controllers\ShortURLController::class, 'topUrl']);

Route::get('/{shortName}', [\App\Http\Controllers\ShortURLController::class, 'routeUrl']);

