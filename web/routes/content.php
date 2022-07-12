<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\FolderController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$path = Str::of(path())->explode("/");

$parent = parent();
$content = null;

if ($parent) $content = $parent->contents()->whereTitle($path->last())->first();

$folders = $path->skip(1);

Route::get("{user}", function(Request $request, User $user) use ($parent, $folders)
{
    return App::make(FolderController::class)
        ->callAction("show", [ $request, $user, $parent, $folders ]);
})->name("my");

Route::prefix("{user}")->name("my.")->group(function() use ($path, $folders, $parent, $content)
{
    Route::post("add-content", function(Request $request, User $user) use ($parent, $folders)
    {
        return App::make(FolderController::class)
            ->callAction("addContent", [ $request, $user, $parent, $folders ]);
    })
    ->name("add-content")
    ->middleware(["auth", "auth.session"]);

    Route::post("create-folder", function(Request $request, User $user) use ($parent, $folders)
    {
        return App::make(FolderController::class)
            ->callAction("createFolder", [ $request, $user, $parent, $folders ]);
    })
    ->name("create-folder")
    ->middleware(["auth", "auth.session"]);

    Route::post("remove", function(Request $request, User $user) use ($parent, $folders)
    {
        return App::make(FolderController::class)
            ->callAction("remove", [ $request, $user, $parent, $folders ]);
    })
    ->name("remove")
    ->middleware(["auth", "auth.session"]);

    Route::post("download", function(Request $request, User $user) use ($parent, $folders)
    {
        return App::make(FolderController::class)
            ->callAction("download", [ $request, $user, $parent, $folders ]);
    })
    ->name("download");

    Route::post("visibility", function(Request $request, User $user) use ($parent, $folders)
    {
        return App::make(FolderController::class)
            ->callAction("visibility", [ $request, $user, $parent, $folders ]);
    })
    ->name("download")
    ->middleware(["auth", "auth.session"]);

    if ($content)
    {
        Route::get($folders->implode("/"), function(Request $request, User $user) use ($parent, $folders, $content)
        {
            return App::make(ContentController::class)
                ->callAction("show", [ $request, $user, $parent, $folders, $content ]);
        });

        Route::prefix($folders->implode("/"))->group(function() use ($parent, $folders, $content)
        {
            Route::post("rename", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("rename", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("tags", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("tags", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("visibility", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("visibility", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("remove", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("remove", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("download", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("download", [ $request, $user, $parent, $folders, $content ]);
            });

            Route::post("like", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("like", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("dislike", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("dislike", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("favorite", function(Request $request, User $user) use ($parent, $folders, $content)
            {
                return App::make(ContentController::class)
                    ->callAction("favorite", [ $request, $user, $parent, $folders, $content ]);
            })->middleware(["auth", "auth.session"]);
        });
    }

    if ($parent) $parent = $parent->folders()->whereTitle($path->last())->first();

    if ($parent)
    {
        Route::get($folders->implode("/"), function(Request $request, User $user) use ($folders, $parent)
        {
            return App::make(FolderController::class)
                ->callAction("show", [ $request, $user, $parent, $folders ]);
        });

        Route::prefix($folders->implode("/"))->group(function() use ($folders, $parent)
        {
            Route::post("add-content", function(Request $request, User $user) use ($folders, $parent)
            {
                return App::make(FolderController::class)
                    ->callAction("addContent", [ $request, $user, $parent, $folders ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("create-folder", function(Request $request, User $user) use ($folders, $parent)
            {
                return App::make(FolderController::class)
                    ->callAction("createFolder", [ $request, $user, $parent, $folders ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("rename", function(Request $request, User $user) use ($parent, $folders)
            {
                return App::make(FolderController::class)
                    ->callAction("rename", [ $request, $user, $parent, $folders ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("remove", function(Request $request, User $user) use ($parent, $folders)
            {
                return App::make(FolderController::class)
                    ->callAction("remove", [ $request, $user, $parent, $folders ]);
            })->middleware(["auth", "auth.session"]);

            Route::post("download", function(Request $request, User $user) use ($parent, $folders)
            {
                return App::make(FolderController::class)
                    ->callAction("download", [ $request, $user, $parent, $folders ]);
            });

            Route::post("visibility", function(Request $request, User $user) use ($parent, $folders)
            {
                return App::make(FolderController::class)
                    ->callAction("visibility", [ $request, $user, $parent, $folders ]);
            });
        });
    }
});

if (Str::of($path->last())->explode(".")->count() === 2 && Storage::disk("public")->exists("contents/" . $path->implode("/")))
{
    Route::get($path->implode("/"), function() use ($path)
    {
        return response()->file(storage_path("app/public/contents/" . $path->implode("/")));
    });
}