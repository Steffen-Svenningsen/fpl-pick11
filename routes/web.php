<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('leaderboard', function () {
        return Inertia::render('Leaderboard');
    })->name('leaderboard');

    Route::get('spilhistorik', function () {
        return Inertia::render('Spilhistorik');
    })->name('spilhistorik');

    Route::get('regler-og-info', function () {
        return Inertia::render('Rules');
    })->name('rules');

    Route::get('om-start-11', function () {
        return Inertia::render('About');
    })->name('about');

    Route::get('premier-league', function () {
        return Inertia::render('PremierLeague');
    })->name('premier-league');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
