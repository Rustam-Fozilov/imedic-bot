<?php

use App\Http\Controllers\ResultController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('project_token')->group(function () {
    Route::post('user-requests', [ResultController::class, 'sendUsers']);
    Route::post('get-results', [ResultController::class, 'getResults']);
});
