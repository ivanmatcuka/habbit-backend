<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\CompletionController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->post('/login', action: [AuthenticatedSessionController::class, 'authenticate']);
Route::middleware('api')->post('/register', action: [AuthenticatedSessionController::class, 'register']);
Route::middleware('api')->post('/recover', action: [NewPasswordController::class, 'recover']);

Route::middleware('auth:api')->get('/tasks', [TaskController::class, 'all']);
Route::middleware('auth:api')->get('/tasks/{task}', [TaskController::class, 'findById']);
Route::middleware('auth:api')->post('/tasks', [TaskController::class, 'create']);
Route::middleware('auth:api')->patch('/tasks/{task}', [TaskController::class, 'update']);
Route::middleware('auth:api')->delete('/tasks/{task}', [TaskController::class, 'delete']);

Route::middleware('auth:api')->post('/complete/{task}', [CompletionController::class, 'store']);
Route::middleware('auth:api')->delete('/uncomplete/{completion}', [CompletionController::class, 'delete']);
