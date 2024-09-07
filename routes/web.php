<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
// Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// Movie Routes
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/now-playing', [MovieController::class, 'nowPlaying']);
Route::get('/movies/upcoming', [MovieController::class, 'upcoming']);
Route::get('/movies/top-rated', [MovieController::class, 'topRated']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/search/movies', [MovieController::class, 'search']);

// TV Routes
Route::get('/tv', [TvController::class, 'index']);
Route::get('/tv/airing-today', [TvController::class, 'airingToday']);
Route::get('/tv/on-the-air', [TvController::class, 'onTheAir']);
Route::get('/tv/top-rated', [TvController::class, 'topRated']);
Route::get('/tv/{id}', [TvController::class, 'show']);
Route::get('/search/tv', [TvController::class, 'search']);
