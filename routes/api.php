<?php

use App\Http\Controllers\API\DemandController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\SquadController;
use App\Http\Controllers\API\SquadUserController;
use App\Http\Controllers\API\UserController;
use Facade\FlareClient\Context\RequestContext;
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
Route::post('/users/register', [UserController::class, 'store'])->middleware(['auth:sanctum', 'type.user']);

Route::put('/users/me', [UserController::class, 'update'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/users/me', [UserController::class, 'me'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/users/me', [UserController::class, 'delete'])->middleware(['auth:sanctum', 'type.user']);

Route::get('/users', [UserController::class, 'getAll'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/users/{id}', [UserController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);
Route::post('/users/login', [UserController::class, 'login']);

// SQUADS
Route::post('/squads/register', [SquadController::class, 'store'])->middleware(['auth:sanctum', 'type.user']);
Route::put('/squads/{id}', [SquadController::class, 'update'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads', [SquadController::class, 'getAll'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{id}', [SquadController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/squads/{id}', [SquadController::class, 'delete'])->middleware(['auth:sanctum', 'type.user']);

// SQUAD USERS
Route::post('/squads/{squad_id}/users/{user_id}/register', [SquadUserController::class, 'store'])->middleware(['auth:sanctum', 'type.user']);
Route::put('/squads/{squad_id}/users/{user_id}', [SquadUserController::class, 'update'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/users', [SquadUserController::class, 'getUsersBySquad'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/users/{user_id}', [SquadUserController::class, 'getBySquadAndUser'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/squads/{squad_id}/users/{user_id}', [SquadUserController::class, 'deleteUserFromSquad'])->middleware(['auth:sanctum', 'type.user']);

// SQUAD PROJECTS
Route::post('/squads/{squad_id}/projects/register', [ProjectController::class, 'store'])->middleware(['auth:sanctum', 'type.user']);
Route::put('/squads/{squad_id}/projects/{project_id}', [ProjectController::class, 'update'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/projects', [ProjectController::class, 'getAllBySquad'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/projects/{project_id}', [ProjectController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/squads/{squad_id}/projects/{project_id}', [ProjectController::class, 'delete'])->middleware(['auth:sanctum', 'type.user']);

// PROJECT DEMANDS
Route::post('/squads/{squad_id}/projects/{project_id}/demands/register', [DemandController::class, 'store'])->middleware(['auth:sanctum', 'type.user']);
Route::put('/squads/{squad_id}/projects/{project_id}/demands/{demand_id}', [DemandController::class, 'update'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/projects/{project_id}/demands', [DemandController::class, 'getAllByProject'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/projects/{project_id}/demands/{demand_id}', [DemandController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);
Route::delete('/squads/{squad_id}/projects/{project_id}/demands/{demand_id}', [DemandController::class, 'delete'])->middleware(['auth:sanctum', 'type.user']);

// PROJECT REQUESTS
Route::get('/squads/{squad_id}/projects/{project_id}/requests', [RequestController::class, 'getAllByProject'])->middleware(['auth:sanctum', 'type.user']);
Route::get('/squads/{squad_id}/projects/{project_id}/requests/{request_id}', [RequestController::class, 'getById'])->middleware(['auth:sanctum', 'type.user']);

// REQUESTS
Route::post('/requests/register', [RequestController::class, 'store'])->middleware(['auth:sanctum', 'type.user']);
