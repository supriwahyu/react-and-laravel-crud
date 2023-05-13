<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WorkerController;

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



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('create', [ProductController::class, 'store']);
    Route::put('update/{product}',  [ProductController::class, 'update']);
    Route::delete('delete/{product}',  [ProductController::class, 'destroy']);

    Route::get('vendor', [VendorController::class, 'index']);
    Route::get('vendor/{id}', [VendorController::class, 'show']);
    Route::post('vendor/create', [VendorController::class, 'store']);
    Route::put('vendor/update/{vendor}',  [VendorController::class, 'update']);
    Route::delete('vendor/delete/{vendor}',  [VendorController::class, 'destroy']);

    Route::get('worker', [WorkerController::class, 'index']);
    Route::get('worker/{id}', [WorkerController::class, 'show']);
    Route::post('worker/create', [WorkerController::class, 'store']);
    Route::put('worker/update/{worker}',  [WorkerController::class, 'update']);
    Route::delete('worker/delete/{worker}',  [WorkerController::class, 'destroy']);

    Route::post('add-products/{id}', [ProductController::class, 'addProductToCart']);
    Route::put('update-cart', [ProductController::class, 'updateCart']);
    Route::delete('remove-from-cart', [ProductController::class, 'removeCart']);