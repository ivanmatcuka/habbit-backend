<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', [\App\Http\Controllers\TaskController::class, 'all']);
Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'create']);
Route::get('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'findById']);
Route::post('/complete/{task}', [\App\Http\Controllers\CompletionController::class, 'store']);
Route::patch('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update']);
Route::delete('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'delete']);
Route::delete('/completions/{completion}', [\App\Http\Controllers\CompletionController::class, 'delete']);
