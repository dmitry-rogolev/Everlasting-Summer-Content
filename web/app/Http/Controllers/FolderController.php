<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Content;
use App\Models\Folder;
use App\Traits\TSort;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Russsiq\Zipper\Facades\Zipper;

class FolderController extends Controller
{
    use TSort;

    public function show(Request $request, Folder $folder)
    {
        $this->settings();

        $this->can = $this->can("show", $folder);

        $breadcrumbs = $this->breadcrumbs($this->createBreadcrumbs($folder));

        $this->setBreadcrumbs($breadcrumbs);

        $sort = $this->sort("title");

        $folders = $this->can ? $folder->folders()->orderBy(...$sort)->get() : null;

        $contents = $this->can 
                        ? $folder->contents()->orderBy(...$sort)->get()
                        : $folder->user->contents()->visibles()->orderBy(...$sort);

        return view("folder", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "user" => $folder->user, 
            "folder" => $folder, 
            "can" => $this->can, 
            "sort" => ($folders ? $folders->count() : false || $contents->count()) ? $sort[1] : false, 
            "download" => $this->isDownload($folder), 

            "folders" => $folders, 

            "contents" => $this->can ? $contents : $contents->paginate(20), 

        ])
        ->all()
        );
    }

    public function add(Request $request, Folder $folder)
    {
        $request->validate([
            "files" => [ "required", "array" ], 
            "files.*" => [ "file", "mimes:jpg,jpeg,png,gif", "max:51200", "distinct" ], 
            "visibility" => [ "string" ], 
        ]);

        $files = $request->file("files");

        $path = pathOfFolder($folder);

        foreach ($files as $file)
        {
            $title = Str::of($file->getClientOriginalName())->beforeLast(".")->limit(255, "");

            if ($folder->contents()->whereTitle($title)->first()) 
                return back()->withErrors(["title" => __("page.content.exists", [ "title" => $title ])]);
            
            else if ($folder->folders()->whereTitle($title)->first())
                return back()->withErrors([ "title" => __("page.folder.used", [ "title" => $title ]) ]);

            Content::create([
                "name" => $title . "." . $file->extension(), 
                "title" => $title, 
                "extension" => $file->extension(), 
                "type" => $file->getClientMimeType(), 
                "path" => $path, 
                "tags" => $title . ($path ? ", " : "") . Str::of($path)->explode("/")->implode(", "), 
                "visibility" => $request->visibility === "true" || $request->visibility === "1", 
                "folder_id" => $folder->id, 
                "user_id" => $folder->user_id, 
            ]);

            $file->storeAs("contents/" . $folder->user_id . "/" . $path, $title . "." . $file->extension(), "public");
        }

        return back();
    }

    public function new(Request $request, Folder $folder)
    {
        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
            "visibility" => [ "string" ], 
        ]);

        if ($folder->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.folder.exists", [ "title" => $request->title ]) ]);
        
        else if ($folder->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.folder.used", [ "title" => $request->title ]) ]);

        $path = pathOfFolder($folder);

        Folder::create([
            "title" => $request->title, 
            "path" => $path, 
            "visibility" => $request->visibility === "true" || $request->visibility === "1", 
            "folder_id" => $folder->id,  
            "user_id" => $folder->user_id, 
        ]);

        Storage::disk("public")
            ->makeDirectory("contents/" . $request->user()->id . "/" . ($path ? $path . "/" : "") . $request->title);

        return back();
    }

    public function rename(Request $request, Folder $folder)
    {
        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        $parent = $folder->folder()->first();

        if ($parent->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.folder.exists", [ "title" => $request->title ]) ]);
        
        else if ($parent->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.folder.used", [ "title" => $request->title ]) ]);

        $path = $folder->path;
        $new_path = Str::of($path)->explode("/")->reverse()->skip(1)->reverse()->push($request->title)->implode("/");

        Storage::disk("public")
            ->move("contents/" . $folder->user_id . "/" . $path, 
                   "contents/" . $folder->user_id . "/" . $new_path);

        $folder->title = $request->title;
        $folder->save();
        
        return back();
    }

    public function remove(Request $request, Folder $folder)
    {
        $parent = $folder->folder()->first();

        $folder->remove();

        return redirect(route("folder", [ "folder" => $parent ? $parent->id : $folder->id ]));
    }

    public function visibility(Request $request, Folder $folder)
    {
        $this->visible($folder, $folder->visibility ? false : true);

        return back();
    }

    private function visible(Folder $folder, bool $visibility)
    {
        $folder->visibility = $visibility;
        $folder->save();

        foreach ($folder->folders()->get() as $folder)
        {
            $this->visible($folder, $visibility);
        }

        foreach ($folder->contents()->get() as $content)
        {
            $content->visibility = $visibility;
            $content->save();
        }
    }

    private function createBreadcrumbs(Folder $folder) : Collection
    {
        $breadcrumbs = new Collection();

        $current = $folder;

        while ($current)
        {
            if (!$current->folder_id)
            {
                $breadcrumbs->put($this->can ? __("page.folder.header") : $current->user->name, route("folder", [ "folder" => $current->user->folder()->first()->id ]));
                $breadcrumbs->put(__("page.welcome"), route("welcome"));
            }
            else 
                $breadcrumbs->put($current->title, route("folder", [ "folder" => $current->id ]));

            $current = $current->folder()->first();
        }

        return $breadcrumbs->reverse();
    }

    private function isDownload(Folder $folder) : bool
    {
        return boolval(Storage::disk("public")->allFiles("contents/" . $folder->user_id . "/" . $folder->path));
    }
}
