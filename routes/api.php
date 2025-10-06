<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FPL\TeamController;
use App\Http\Controllers\FPL\PlayerController;
use App\Http\Controllers\FPL\GameweekController;
use App\Http\Controllers\FPL\LeaderboardController;

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/gameweeks', [GameweekController::class, 'index']);
    Route::get('/players', [PlayerController::class, 'index']); // optional ?gameweek=1
    Route::post('/teams', [TeamController::class, 'store']);
    Route::get('/teams/{gameweek}', [TeamController::class, 'show']);
    Route::get('/leaderboard', [LeaderboardController::class, 'index']);
});
