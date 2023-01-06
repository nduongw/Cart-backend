<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cart\CartController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('add-to-cart', [CartController::class, 'addToCart']);
Route::get('orders', [CartController::class, 'showCart']);
Route::post('update', [CartController::class, 'updateQuantity']);
Route::delete('delete/{id}', [CartController::class, 'deleteProduct']);
// Route::get('/cart', [CartController::class, 'viewCart']);