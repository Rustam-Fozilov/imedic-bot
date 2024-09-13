<?php

use App\Http\Controllers\ResultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('users', [ResultController::class, 'sendUsers'])->name('result.store');
Route::post('results', [ResultController::class, 'syncResults'])->name('result.sync');
