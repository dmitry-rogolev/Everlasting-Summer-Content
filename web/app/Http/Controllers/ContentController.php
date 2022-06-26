<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    protected Content $content;

    public function show(Request $request, $id, $title, Folder|User $parent, Collection $folders, Content $content)
    {
        $this->settings(null, true);

        $this->can($id);

        $this->content = $content;

        $breadcrumbs = $this->breadcrumbs($folders);

        return view("content", $this->data->merge([

            "header" => $content->title, 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "path" => Str::of($folders->implode("/"))->lower(), 

            "content" => $content, 

            "rename" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "remove" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),

        ])
        ->all()
        );
    }

    public function rename(Request $request, $id, $title, Folder|User $parent, Collection $folders, Content $content)
    {
        $this->can($id);

        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        if ($parent->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.content.exists", [ "title" => $request->title ]) ]);
        
        else if ($parent->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);
        
        $path = $folders->implode("/");

        Storage::disk("public")
            ->move("contents/" . $request->user()->id . "/" . ($path ? Str::lower($path) . "/" : $path) . Str::lower($content->title) . "." . $content->extension, 
                   "contents/" . $request->user()->id . "/" . ($path ? Str::lower($path) . "/" : $path) . Str::lower($request->title) . "." . $content->extension);

        $content->title = $request->title;
        $content->save();

        return redirect(url($request->user()->id . "/" . ($path ? $path . "/" : $path) . $request->title));
    }

    public function remove(Request $request, $id, $title, Folder|User $parent, Collection $folders, Content $content)
    {
        $this->can($id);

        $path = $folders->implode("/");

        Storage::disk("public")
            ->delete("contents/" . $request->user()->id . "/" . ($path ? Str::lower($path) . "/" : $path) . Str::lower($content->title) . "." . $content->extension);

        $content->delete();

        return redirect(url($request->user()->id . "/" . $path));
    }

    protected function can(int $id)
    {
        if ($id !== request()->user()->id) abort(404);
    }

    protected function parent(Collection $folders)
    {
        $parent = request()->user();

        foreach ($folders as $folder)
        {
            $parent = $parent->folders()->whereTitle($folder)->first();
        }

        return $parent;
    }

    protected function breadcrumbs(Collection $folders)
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
        $breadcrumbs->push(new Collection([
            "name" => $this->content->title, 
            "url" => url(request()->user()->id . "/" . ($path ? $path . "/" : $path) . $this->content->title), 
            $this->content->title, 
            url(request()->user()->id . "/" . ($path ? $path . "/" : $path) . $this->content->title), 
        ]));

        parent::breadcrumbs($breadcrumbs);

        return $breadcrumbs;
    }
}
