<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Content;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FolderController extends Controller
{
    public function show(Request $request, $id, Folder|User $parent = null, Collection $folders = null)
    {
        $this->settings(null, true);

        $this->can($id);

        $breadcrumbs = $this->breadcrumbs($folders);

        if (!$parent) $parent = $this->parent($folders);

        return view("folder", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "path" => $folders ? $folders->implode("/") : "", 

            "create_folder" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),

            "add_content" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "rename" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "show" => $folders ? true : false, 
            ]), 

            "remove" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "folders" => $parent->folders()->orderBy("title")->get(), 

            "contents" => $parent->contents()->orderBy("title")->get(), 

        ])
        ->all()
        );
    }

    public function addContent(Request $request, $id, Folder|User $parent = null, Collection $folders = null)
    {
        $this->can($id);

        $request->validate([
            "title" => [ "max:255" ], 
            "file" => [ "required", "file", "mimes:jpg,jpeg,png,gif", "max:51200" ], 
        ]);

        if (!$parent) $parent = $this->parent($folders);

        $file = $request->file("file");

        $name = Str::of($file->getClientOriginalName())->beforeLast(".");

        if ($request->title && $parent->contents()->whereTitle($request->title)->first())
            return back()->withErrors(["title" => __("page.content.exists", [ "title" => $request->title ])]);
    
        else if (!$request->title && $parent->contents()->whereTitle($name)->first()) 
            return back()->withErrors(["title" => __("page.content.exists", [ "title" => $name ])]);
        
        else if ($request->title && $parent->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);

        else if (!$request->title && $parent->folders()->whereTitle($name)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $name ]) ]);

        $path = $folders ? $folders->implode("/") : "";

        Content::create([
            "title" => $request->title ?? $name, 
            "extension" => $file->extension(), 
            "type" => $file->getClientMimeType(), 
            "folder_id" => $path ? $parent->id : 0, 
            "user_id" => $request->user()->id, 
        ]);

        $file->storeAs("contents/" . $request->user()->id . "/" . Str::lower($path), Str::lower($request->title ?? $name) . "." . $file->extension(), "public");

        return back();
    }

    public function createFolder(Request $request, $id, Folder|User $parent = null, Collection $folders = null)
    {
        $this->can($id);

        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        if (!$parent) $parent = $this->parent($folders);

        if ($parent->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.exists", [ "title" => $request->title ]) ]);
        
        else if ($parent->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);

        $path = $folders ? $folders->implode("/") : "";;

        Folder::create([
            "title" => $request->title, 
            "folder_id" => $path ? $parent->id : null,  
            "user_id" => $request->user()->id, 
        ]);

        Storage::disk("public")
            ->makeDirectory("contents/" . $request->user()->id . "/" . ($path ? Str::lower($path) . "/" : $path) . Str::lower($request->title));

        return back();
    }

    public function rename(Request $request, $id, Folder|User $parent = null, Collection $folders = null)
    {
        $this->can($id);

        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        if ($parent instanceof User) return back();

        $p = $parent->folder()->first();

        if (!$p && $p->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.exists", [ "title" => $request->title ]) ]);

        else if ($p && $p->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.exists", [ "title" => $request->title ]) ]);
        
        else if ($p && $p->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);

        $parent->title = $request->title;
        $parent->save();

        $path = $folders ? $folders->implode("/") : "";
        $new_path = $folders ? $folders->reverse()->skip(1)->reverse()->implode("/") : "";
        if ($new_path) $new_path .= "/";

        Storage::disk("public")
            ->move("contents/" . $request->user()->id . "/" . Str::lower($path), 
                   "contents/" . $request->user()->id . "/" . Str::lower($new_path) . Str::lower($request->title));
        
        return redirect(url($request->user()->id . "/" . $new_path . $request->title));
    }

    public function remove(Request $request, $id, Folder|User $parent = null, Collection $folders = null)
    {
        $this->can($id);

        if (!$parent) $parent = $this->parent($folders);

        $path = $folders ? $folders->implode("/") : "";
        
        Storage::disk("public")
            ->deleteDirectory("contents/" . $request->user()->id . "/" . Str::lower($path));

        $parent->remove();

        $path = Str::of($path)->explode("/");
        $path->pop();
        $path = $path->implode("/");

        return redirect(url($request->user()->id . "/" . $path));
    }

    protected function can(int $id)
    {
        if ($id !== request()->user()->id) abort(404);
    }

    protected function parent(Collection $folders = null)
    {
        $parent = request()->user();

        if ($folders)
        {
            foreach ($folders as $folder)
            {
                $parent = $parent->folders()->whereTitle($folder)->first();
            }
        }

        return $parent;
    }

    protected function breadcrumbs(Collection $folders = null)
    {
        $breadcrumbs = new Collection([
            new Collection([ 
                "name" => __("page.welcome"), 
                "url" => route("welcome"), 
                __("page.welcome"), 
                route("welcome"), 
            ]), 
            new Collection([
                "name" => __("page.my.header"), 
                "url" => route("my", [ "id" => request()->user()->id ]), 
                __("page.my.header"), 
                route("my", [ "id" => request()->user()->id ]), 
            ]), 
        ]);

        if ($folders)
        {
            $path = "";
            $f = request()->user();
            foreach ($folders as $folder)
            {
                $path .= $folder . "/";
                $f = $f->folders()->whereTitle($folder)->first();
                $breadcrumbs->push(new Collection([
                    "name" => $f->title, 
                    "url" => url(request()->user()->id . "/" . $path), 
                    $f->title, 
                    url(request()->user()->id . "/" . $path), 
                ]));
            }
        }

        parent::breadcrumbs($breadcrumbs);

        return $breadcrumbs;
    }
}
