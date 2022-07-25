<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\LikeController;

Route::prefix("comment/{comment}")->middleware(["auth", "auth.session"])->name("comment.")->group(function()
{
    Route::post("change", [ CommentController::class, "change" ])
        ->can("show", "comment")
        ->name("change");

    Route::post("remove", [ CommentController::class, "remove" ])
        ->can("remove", "comment")
        ->name("remove");

    Route::post("like", [ LikeController::class, "like" ])
        ->name("like");

    Route::post("dislike", [ DislikeController::class, "dislike" ])
        ->name("dislike");
});
