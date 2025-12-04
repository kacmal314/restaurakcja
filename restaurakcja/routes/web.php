<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
  return redirect()->route('taskapi.create');
});

Route::get('/dashboard', function () {
  throw "deshboard undefined";
})->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::middleware('auth')->group(function () {


  Route::get('/taskapi/create', [TaskApiController::class, 'create'])
    ->name('taskapi.create');

  Route::post('/taskapi/store', [TaskApiController::class, 'store'])
    ->name('taskapi.store');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
// SANCTUM
//

Route::get('/api/tokens/create', function (Request $request) {
  
  $token = $request->user()->createToken(
    'api-token',
    ['task-request', 'task-complete']
  );

  dd($token->plainTextToken);
});

//
// ^^^ SANCTUM ^^^
//

require __DIR__.'/auth.php';
