<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("user/{user}", [ UserController::class, "show" ])
    ->name("user");

Route::middleware(["auth", "auth.session"])->prefix("user/{user}")->name("user.")->group(function()
{
    Route::post("avatar", [ AvatarController::class, "avatar" ])
        ->can("show", "user")
        ->name("avatar");

    Route::post("remove-avatar", [ AvatarController::class, "removeAvatar" ])
        ->can("show", "user")
        ->name("avatar.remove");

    Route::post("name", [ UserController::class, "name" ])
        ->can("show", "user")
        ->name("name");

    Route::post("email", [ UserController::class, "email" ])
        ->can("show", "user")
        ->name("email");

    Route::post("email-visibility", [ UserController::class, "emailVisibility" ])
        ->can("show", "user")
        ->name("email-visibility");

    Route::post("password", [ UserController::class, "password" ])
        ->can("show", "user")
        ->name("password");

    Route::get("delete", [ DeleteUserController::class, "show" ])
        ->can("show", "user")
        ->middleware(["password.confirm"])
        ->name("delete");

    Route::post("delete", [ DeleteUserController::class, "destroy" ])
        ->can("show", "user")
        ->middleware(["password.confirm"]);
});
