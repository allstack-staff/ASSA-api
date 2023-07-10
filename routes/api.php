<?php

use App\Http\Controllers\API\UserController;
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

// USERS
Route::post('/users/register', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users', [UserController::class, 'getAll'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/users/{id}', [UserController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
Route::post('/users/login', [UserController::class, 'login']);
Route::get('/users/me', [UserController::class, 'me'])->middleware(['auth:sanctum', 'type.user']);