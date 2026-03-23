<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\FreelanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/client/registerClient', [AuthController::class, 'registerClient']);
Route::post('/client/registerFreelance', [AuthController::class, 'registerFreelance']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource("clients", ClientController::class)->middleware("auth:sanctum");
Route::apiResource("freelances", FreelanceController::class)->middleware("auth:sanctum");
