<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CandidatureController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\CompetenceController;
use App\Http\Controllers\API\FreelanceController;
use App\Http\Controllers\API\MissionController;
use App\Http\Controllers\API\TechnologyController;
use Illuminate\Support\Facades\Route;

Route::post('/client/registerClient', [AuthController::class, 'registerClient']);
Route::post('/client/registerFreelance', [AuthController::class, 'registerFreelance']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware("auth:sanctum")->group(function(){

    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource("clients", ClientController::class);
    Route::apiResource("freelances", FreelanceController::class);
    Route::apiResource("missions", MissionController::class);
    Route::post("/missions/{mission}/apply", [MissionController::class, 'applyAuMissionParCandidature']);
    Route::post("/missions/{mission}/reviewFreelance", [MissionController::class, 'reviewFreelance']);
    Route::post("/missions/{mission}/reviewClient", [MissionController::class, 'reviewClient']);
    Route::apiResource("competences", CompetenceController::class)->middlewareFor(['create', 'update', 'delete', 'show'], 'isAdmin');
    Route::apiResource("technologies", TechnologyController::class)->middlewareFor(['create', 'update', 'delete', 'show'], 'isAdmin');
    Route::apiResource("candidatures", CandidatureController::class);
    Route::put("/candidatures/{candidature}/accept", [CandidatureController::class, 'acceptCandidature']);
    Route::put("/candidatures/{candidature}/reject", [CandidatureController::class, 'rejectCandidature']);

});
//Route::prefix('admin')->middleware('isAdmin')->group(function(){
    Route::get('/stats', [AdminController::class, 'index']);
    Route::put('/users/{user}/status', [AdminController::class, 'update']);
    Route::put('/users/{user}/status', [AdminController::class, 'update']);
//});
