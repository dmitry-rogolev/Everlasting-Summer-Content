<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\DeleteProfileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

    Route::get("{id}", function(Request $request, $id)
    {
        return App::make(FolderController::class)
            ->callAction("show", [ $request, $id ]);
    })
    ->where("id", "[\d]+")
    ->name("my");

    Route::prefix("{id}")->name("my.")->group(function()
    {
        Route::post("add-content", function(Request $request, $id)
        {
            return App::make(FolderController::class)
                ->callAction("addContent", [ $request, $id ]);
        })->name("add-content");

        Route::post("create-folder", function(Request $request, $id)
        {
            return App::make(FolderController::class)
                ->callAction("createFolder", [ $request, $id ]);
        })->name("create-folder");

        Route::post("rename", function(Request $request, $id)
        {
            return App::make(FolderController::class)
                ->callAction("rename", [ $request, $id ]);
        })->name("rename");

        Route::post("remove", function(Request $request, $id)
        {
            return App::make(FolderController::class)
                ->callAction("remove", [ $request, $id ]);
        })->name("remove");

        $path = Str::of(urldecode(request()->path()))->explode("/");

        if ($path && intval($path->first()))
        {
            if 
            (
                $path->last() === "add-content" || 
                $path->last() === "create-folder" || 
                $path->last() === "rename" || 
                $path->last() === "remove" || 
                $path->last() === "download"
            )
            $path->pop();
    
            $path = Str::of($path->implode("/"));
    
            $parent = User::find($path->before("/"));
    
            $folders = $path->after("/")->explode("/");
            $folders->pop();
    
            $break = false;
    
            foreach ($folders as $folder)
            {
                $p = $parent->folders()->whereTitle($folder)->first();
                if ($p) $parent = $p;
                else 
                {
                    $break = true;
                    break;
                }
            }
    
            if (!$break && $parent) $content = $parent->contents()->whereTitle($path->afterLast("/"))->first();
    
            if (!$break && isset($content) && $content)
            {
                Route::get($folders->implode("/") . "/{content}", 
                function(Request $request, $id, $title) use ($parent, $folders, $content)
                {
                    return App::make(ContentController::class)
                        ->callAction("show", [ $request, $id, $title, $parent, $folders, $content ]);
                });
    
                Route::prefix($folders->implode("/") . "/{content}")->group(function() use ($parent, $folders, $content)
                {
                    Route::post("rename", 
                    function(Request $request, $id, $title) use ($parent, $folders, $content)
                    {
                        return App::make(ContentController::class)
                            ->callAction("rename", [ $request, $id, $title, $parent, $folders, $content ]);
                    });
    
                    Route::post("remove", 
                    function(Request $request, $id, $title) use ($parent, $folders, $content)
                    {
                        return App::make(ContentController::class)
                            ->callAction("remove", [ $request, $id, $title, $parent, $folders, $content ]);
                    });

                    Route::post("download", 
                    function(Request $request, $id, $title) use ($parent, $folders, $content)
                    {
                        return App::make(ContentController::class)
                            ->callAction("download", [ $request, $id, $title, $parent, $folders, $content ]);
                    });
                });
            }
    
            if (!$break && $parent) $parent = $parent->folders()->whereTitle($path->afterLast("/"))->first();
    
            if (!$break && $parent)
            {
                $folders = $path->after("/");
    
                Route::get($folders, function(Request $request, $id) use ($folders, $parent)
                {
                    return App::make(FolderController::class)
                        ->callAction("show", [ $request, $id, $parent, $folders->explode("/") ]);
                });
    
                Route::prefix($folders)->group(function() use ($folders, $parent)
                {
                    Route::post("add-content", function(Request $request, $id) use ($folders, $parent)
                    {
                        return App::make(FolderController::class)
                            ->callAction("addContent", [ $request, $id, $parent, $folders->explode("/") ]);
                    });
    
                    Route::post("create-folder", function(Request $request, $id) use ($folders, $parent)
                    {
                        return App::make(FolderController::class)
                            ->callAction("createFolder", [ $request, $id, $parent, $folders->explode("/") ]);
                    });
    
                    Route::post("rename", function(Request $request, $id) use ($parent, $folders)
                    {
                        return App::make(FolderController::class)
                            ->callAction("rename", [ $request, $id, $parent, $folders->explode("/") ]);
                    });
    
                    Route::post("remove", function(Request $request, $id) use ($parent, $folders)
                    {
                        return App::make(FolderController::class)
                            ->callAction("remove", [ $request, $id, $parent, $folders->explode("/") ]);
                    });
                });
            }
        }
    });
});

require __DIR__.'/auth.php';
