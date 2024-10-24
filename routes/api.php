<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('forms', \App\Http\Controllers\Api\FormController::class)->only(['index', 'show']);
    Route::resource('markers', \App\Http\Controllers\Api\MarkerController::class)->only(['index', 'show']);
    Route::resource('assets', \App\Http\Controllers\Api\AssetController::class)->only(['index', 'show']);
    Route::resource('environments', \App\Http\Controllers\Api\EnvironmentController::class)->only(['index', 'show']);
    Route::resource('tasks', \App\Http\Controllers\Api\TaskController::class)->only(['index', 'show']);
});
