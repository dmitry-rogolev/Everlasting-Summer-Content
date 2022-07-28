<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
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

Route::get("/", [ WelcomeController::class, "show" ])
    ->name("welcome");

Route::get("search", [ SearchController::class, "show" ])
    ->name("search");

Route::get("favorite", [ FavoriteController::class, "show" ])
    ->middleware(["auth", "auth.session"])
    ->name("favorite");

Route::post("favorite/download", [ DownloadController::class, "downloadFavorites" ])
    ->middleware(["auth", "auth.session"])
    ->name("favorite.download");
