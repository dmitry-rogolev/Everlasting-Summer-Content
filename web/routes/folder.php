<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::get("folder/{folder}", [ FolderController::class, "show" ])
    ->can("visible", "folder")
    ->name("folder");

Route::prefix("folder/{folder}")->name("folder.")->group(function()
{
    Route::post("add", [ FolderController::class, "add" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "folder")
        ->name("add");

    Route::post("new", [ FolderController::class, "new" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "folder")
        ->name("new");
    
    Route::post("rename", [ FolderController::class, "rename" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "folder")
        ->name("rename");

    Route::post("remove", [ FolderController::class, "remove" ])
        ->middleware(["auth", "auth.session"])
        ->can("remove", "folder")
        ->name("remove");

    Route::post("download", [ DownloadController::class, "download" ])
        ->name("download");

    Route::post("visibility", [ FolderController::class, "visibility" ])
        ->middleware(["auth", "auth.session"])
        ->can("show", "folder")
        ->name("visibility");
});

