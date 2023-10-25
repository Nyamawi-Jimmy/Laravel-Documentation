<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login",[\App\Http\Controllers\AuthController::class,"login"]);
Route::post("/register",[\App\Http\Controllers\AuthController::class,"register"]);

//Books
Route::get("/books",[\App\Http\Controllers\BooksController::class,"index"]);
Route::get("/books/{id}",[\App\Http\Controllers\BooksController::class,"show"]);
Route::post("/books",[\App\Http\Controllers\BooksController::class,"store"]);
Route::put("/books/{id}",[\App\Http\Controllers\BooksController::class,"update"]);
Route::delete("/books/{id}",[\App\Http\Controllers\BooksController::class,"destroy"]);






