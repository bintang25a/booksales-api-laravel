<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('/authors', AuthorController::class)->only(['index', 'show']);
Route::apiResource('books', BookController::class)->only(['index', 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function() {

    Route::middleware(['role:admin'])->group(function() {
        Route::apiResource('/genres', GenreController::class)->only(['store', 'destroy']);
        Route::post('/genres/{id}', [GenreController::class, 'update']);
    
        Route::apiResource('/authors', AuthorController::class)->only(['store', 'destroy']);
        Route::post('/authors/{id}', [AuthorController::class, 'update']);
    
        Route::apiResource('/books', BookController::class)->only(['store', 'destroy']);
        Route::post('/books/{id}', [BookController::class, 'update']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});