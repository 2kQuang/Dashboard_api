<?php

use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::get('', [UserController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/update', [UserController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');
});


Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy']);
    Route::get('/{id}/products', [CategoryController::class, 'show']);
});

Route::prefix('product')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('ticket')->group(function () {
    Route::get('', [TicketController::class, 'index']);
    Route::post('/store', [TicketController::class, 'store']);
    Route::put('/update/{id}', [TicketController::class, 'update']);
    Route::delete('/destroy/{id}', [TicketController::class, 'destroy']);
});

Route::prefix('review')->group(function () {
    Route::get('', [ReviewController::class, 'index']);
    Route::post('/store', [ReviewController::class, 'store']);
    Route::put('/update/{id}', [ReviewController::class, 'update']);
    Route::delete('/destroy/{id}', [ReviewController::class, 'destroy']);
});

Route::prefix('cart')->group(function () {
    Route::get('', [CartController::class, 'index']);
    Route::post('/store', [CartController::class, 'store']);
    Route::put('/update/{id}', [CartController::class, 'update']);
    Route::delete('/destroy/{id}', [CartController::class, 'destroy']);
});