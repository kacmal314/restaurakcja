<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//
// SANCTUM
//

Route::get('/task/next', [TaskApiController::class, 'next'])
  // ability: specify which function is allowed
  ->middleware(['auth:sanctum', 'ability:task-request']);

Route::post('/task/{id}/done', [TaskApiController::class, 'markDone'])
  ->middleware(['auth:sanctum', 'ability:task-complete']);

//
// ^^^ SANCTUM ^^^
//