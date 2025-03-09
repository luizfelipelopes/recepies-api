<?php

use App\Http\Controllers\Api\V1\RecipiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// api/V1

Route::group(['prefix' => 'V1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('recipies', RecipiesController::class);
});