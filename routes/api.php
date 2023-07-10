<?php

use App\Http\Controllers\API\SquadController;
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

Route::put('/users/me', [UserController::class, 'update'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/users/me', [UserController::class, 'me'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/users/me', [UserController::class, 'delete'])->middleware(['auth:sanctum', 'type.user']);

Route::get('/users', [UserController::class, 'getAll'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/users/{id}', [UserController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);
Route::post('/users/login', [UserController::class, 'login']);

// SQUADS
Route::post('/squads/register', [SquadController::class, 'store']);
Route::put('/squads/{id}', [SquadController::class, 'update']);
Route::get('/squads', [SquadController::class, 'getAll']);
Route::get('/squads/{id}', [SquadController::class, 'getById']);