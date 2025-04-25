<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustormersController;
use App\Http\Controllers\ProdcutsController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::middleware('auth:sanctum')->group(function () {
 
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('custormers')->group(function () {
    Route::get('/', [CustormersController::class, 'index']);
    Route::get('/{id}', [CustormersController::class, 'show']);
    Route::post('/', [CustormersController::class, 'store']);
    Route::put('/{id}', [CustormersController::class, 'update']);
    Route::delete('/{id}', [CustormersController::class, 'destroy']);
});

Route::prefix('prodcuts')->group(function () {
    Route::get('/', [ProdcutsController::class, 'index']);
    Route::get('/{id}', [ProdcutsController::class, 'show']);
    Route::post('/', [ProdcutsController::class, 'store']);
    Route::put('/{id}', [ProdcutsController::class, 'update']);
    Route::delete('/{id}', [ProdcutsController::class, 'destroy']);
});
