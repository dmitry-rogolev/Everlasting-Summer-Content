<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Content;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Russsiq\Zipper\Facades\Zipper;

class FolderController extends Controller
{
    protected User $user;

    protected bool $can;

    public function show(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        $this->settings(null, true);

        $this->can = $this->can($parent);
                        
        $this->user = $this->can ? $request->user() : $user;

        $breadcrumbs = $this->breadcrumbs($folders);

        return view("folder", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "path" => $folders->implode("/"), 
            "can" => $this->can, 
            "user" => $this->user, 

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
                "show" => $parent instanceof Folder ? true : false, 
            ]), 

            "remove" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "visibility" => new Collection([
                "header" => $parent->visibility ? __("page.my.public") : __("page.my.private"),
                "title" => $parent->visibility ? __("page.my.private-text") : __("page.my.public-text"), 
            ]), 

            "contents" => $this->can 
                            ? $parent->folders()->orderBy("title")->get()->merge(
                                $parent->contents()->orderBy("title")->get()->all()
                            )
                            : $parent->folders()->visibles()->orderBy("title")->get()->merge(
                                $parent->contents()->visibles()->orderBy("title")->get()
                            ), 

        ])
        ->all()
        );
    }

    public function addContent(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        if (!$this->can($parent)) abort(404);

        $request->validate([
            "files" => [ "required", "array" ], 
            "files.*" => [ "file", "mimes:jpg,jpeg,png,gif", "max:51200", "distinct" ], 
            "visibility" => [ "string" ], 
        ]);

        $files = $request->file("files");

        $path = $folders->implode("/");

        foreach ($files as $file)
        {
            $title = Str::of($file->getClientOriginalName())->beforeLast(".")->limit(255, "");

            if ($parent->contents()->whereTitle($title)->first()) 
                return back()->withErrors(["title" => __("page.content.exists", [ "title" => $title ])]);
            
            else if ($parent->folders()->whereTitle($title)->first())
                return back()->withErrors([ "title" => __("page.my.used", [ "title" => $title ]) ]);

            Content::create([
                "name" => $title . "." . $file->extension(), 
                "title" => $title, 
                "extension" => $file->extension(), 
                "type" => $file->getClientMimeType(), 
                "path" => $path ?: null, 
                "visibility" => $request->visibility === "true" || $request->visibility === "1", 
                "tags" => $title . ", " . $folders->implode(", "), 
                "folder_id" => $path ? $parent->id : 0, 
                "user_id" => $request->user()->id, 
            ]);

            $file->storeAs("contents/" . $request->user()->id . "/" . $path, $title . "." . $file->extension(), "public");
        }

        return back();
    }

    public function createFolder(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        if (!$this->can($parent)) abort(404);

        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
            "visibility" => [ "string" ], 
        ]);

        if ($parent->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.exists", [ "title" => $request->title ]) ]);
        
        else if ($parent->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);

        $path = $folders->implode("/");

        Folder::create([
            "title" => $request->title, 
            "path" => $path ?: null, 
            "visibility" => $request->visibility === "true" || $request->visibility === "1", 
            "folder_id" => $path ? $parent->id : null,  
            "user_id" => $request->user()->id, 
        ]);

        Storage::disk("public")
            ->makeDirectory("contents/" . $request->user()->id . "/" . ($path ? $path . "/" : "") . $request->title);

        return back();
    }

    public function rename(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        if (!$this->can($parent)) abort(404);

        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        if ($parent instanceof User) return back();

        $p = $parent->folder()->first();

        if ($p->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.exists", [ "title" => $request->title ]) ]);
        
        else if ($p->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);

        $parent->title = $request->title;
        $parent->save();

        $path = $folders->implode("/");
        $new_path = $folders->reverse()->skip(1)->reverse()->implode("/");
        if ($new_path) $new_path .= "/";

        Storage::disk("public")
            ->move("contents/" . $request->user()->id . "/" . $path, 
                   "contents/" . $request->user()->id . "/" . $new_path . $request->title);
        
        return redirect(url($request->user()->id . "/" . $new_path . $request->title));
    }

    public function remove(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        if (!$this->can($parent)) abort(404);

        $path = $folders->implode("/");
        
        Storage::disk("public")
            ->move("contents/" . $request->user()->id . "/" . $path, 
                   "../deletes/contents/" . $request->user()->id . "/" . $path);

        $parent->remove();

        $path = Str::of($path)->explode("/");
        $path->pop();
        $path = $path->implode("/");

        return redirect(url($request->user()->id . "/" . $path));
    }

    public function download(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        $path = $folders->implode("/");

        $title = $parent instanceof User ? $parent->name : $parent->title;

        $name = Str::random(60);

        $zip = Zipper::create(storage_path("app/tmp/" . $name . ".zip"));

        $zip->addDirectory(storage_path("app/public/contents/" . $user->id . "/" . $path), $title);

        $zip->close();

        return response()->download(storage_path("app/tmp/" . $name . ".zip"))->deleteFileAfterSend();
    }

    public function visibility(Request $request, User $user, Folder|User $parent, Collection $folders)
    {
        if (!$this->can($parent)) abort(404);

        $visibility = $parent->visibility ? false : true;

        $this->visible($parent, $visibility);

        return back();
    }

    protected function can(User|Folder $folder)
    {
        if (Auth::check()) 
        {
            if ($folder instanceof User)
            {
                return request()->user()->can("show", $folder);
            }
            else 
            {
                return request()->user()->can("show", $folder);
            }
        }
        else 
        {
            return false;
        }
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
                "name" => $this->can ? __("page.my.header") : $this->user->name, 
                "url" => route("my", [ "user" => $this->user->id ]), 
                $this->can ? __("page.my.header") : $this->user->name, 
                route("my", [ "user" => $this->user->id ]), 
            ]), 
        ]);

        if ($folders)
        {
            $path = "";
            $f = $this->user;
            foreach ($folders as $folder)
            {
                $f = $f->folders()->whereTitle($folder)->first();
                $path .= $f->title . "/";
                $breadcrumbs->push(new Collection([
                    "name" => $f->title, 
                    "url" => url($this->user->id . "/" . $path), 
                    $f->title, 
                    url($this->user->id . "/" . $path), 
                ]));
            }
        }

        parent::breadcrumbs($breadcrumbs);

        return $breadcrumbs;
    }

    private function visible(Folder|User $parent, bool $visibility)
    {
        $parent->visibility = $visibility;
        $parent->save();

        foreach ($parent->folders()->get() as $folder)
        {
            $this->visible($folder, $visibility);
        }

        foreach ($parent->contents()->get() as $content)
        {
            $content->visibility = $visibility;
            $content->save();
        }
    }
}
