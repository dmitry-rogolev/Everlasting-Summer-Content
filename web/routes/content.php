<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get("content/{content}", [ ContentController::class, "show" ])
    ->can("visible", "content")
    ->name("content");

Route::get("content/{content}/only", [ ContentController::class, "only" ])
    ->can("visible", "content")
    ->name("content.only");

Route::prefix("content/{content}")->name("content.")->group(function()
{
    Route::post("description", [ ContentController::class, "definition" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "content")
        ->name("description");

    Route::post("tags", [ ContentController::class, "tags" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "content")
        ->name("tags");
    
    Route::post("rename", [ ContentController::class, "rename" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "content")
        ->name("rename");

    Route::post("remove", [ ContentController::class, "remove" ])
        ->middleware(["auth", "auth.session"])
        ->can("remove", "content")
        ->name("remove");

    Route::post("download", [ DownloadController::class, "download" ])
        ->name("download");

    Route::post("visibility", [ ContentController::class, "visibility" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "content")
        ->name("visibility");

    Route::post("favorite", [ FavoriteController::class, "favorite" ])
        ->middleware(["auth", "auth.session"])
        ->name("favorite");
    
    Route::post("like", [ LikeController::class, "like" ])
        ->middleware(["auth", "auth.session"])
        ->name("like");

    Route::post("dislike", [ DislikeController::class, "dislike" ])
        ->middleware(["auth", "auth.session"])
        ->name("dislike");

    Route::post("comment", [ CommentController::class, "comment" ])
        ->middleware(["auth", "auth.session"])
        ->name("comment");

    Route::post("comment/{comment}/comment", [ CommentController::class, "comment" ])
        ->middleware(["auth", "auth.session"])
        ->name("comment.comment");
});
