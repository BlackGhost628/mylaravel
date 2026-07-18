<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ArticleApiController;

Route::prefix('v1')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/{id}', [ProductApiController::class, 'show']);
    Route::get('/articles', [ArticleApiController::class, 'index']);
    Route::get('/articles/{slug}', [ArticleApiController::class, 'show']);
});

// مسیر محافظت‌شده با Sanctum (نیاز به لاگین)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});