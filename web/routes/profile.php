<?php

use App\Http\Controllers\DeleteProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "auth.session"])->group(function()
{
    Route::get("profile", [ ProfileController::class, "show" ])
        ->name("profile");

    Route::prefix("profile")->name("profile.")->group(function()
    {
        Route::post("avatar", [ ProfileController::class, "avatar" ])
            ->name("avatar");

        Route::post("name", [ ProfileController::class, "name" ])
            ->name("name");

        Route::post("email", [ ProfileController::class, "email" ])
            ->name("email");

        Route::post("password", [ ProfileController::class, "password" ])
            ->name("password");

        Route::get("delete", [ DeleteProfileController::class, "show" ])
            ->middleware(["password.confirm"])
            ->name("delete");

        Route::post("delete", [ DeleteProfileController::class, "destroy" ])
            ->middleware(["password.confirm"])
            ->name("delete");
    });
});
