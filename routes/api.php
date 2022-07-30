<?php

use Illuminate\Support\Facades\Route;


Route::prefix('parents')->group(function () {
    Route::post('register', [\App\Http\Controllers\Api\ParentsAuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\ParentsAuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('parents')->group(function () {
        Route::post('assign-partner', [\App\Http\Controllers\Api\ParentsController::class, 'assignPartner']);
        Route::get('partners', [\App\Http\Controllers\Api\ParentsController::class, 'getPartners']);
    });

    Route::apiResource('children', \App\Http\Controllers\Api\ChildrenController::class);

});
