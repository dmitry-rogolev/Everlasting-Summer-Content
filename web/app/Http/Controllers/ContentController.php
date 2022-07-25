<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Traits\TSort;
use App\Traits\TView;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    use TSort, TView;

    public function show(Request $request, Content $content)
    {
        $this->settings();

        $this->can = $this->can("show", $content);

        $breadcrumbs = $this->breadcrumbs($this->createBreadcrumbs($content));

        $this->setBreadcrumbs($breadcrumbs);

        $this->view($content);

        $sort = $this->sort("updated_at");

        $comments = $content->comments()->whereCommentId(null)->orderBy(...$sort);

        return view("content", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "can" => $this->can, 
            "user" => $content->user, 
            "sort" => $comments->count() ? $sort[1] : false, 

            "content" => $content, 

            "comments" => $comments->get(), 

        ])
        ->all()
        );
    }

    public function rename(Request $request, Content $content)
    {
        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        $parent = $content->folder;

        if ($parent->contents()->whereTitle($request->title)->first())
            return back()
                ->withErrors([ "title" => __("page.content.exists", [ "title" => $request->title ]) ]);
        
        else if ($parent->folders()->whereTitle($request->title)->first())
            return back()
                ->withErrors([ "title" => __("page.folder.used", [ "title" => $request->title ]) ]);
        
        $path = $content->path;

        $path = $path ? $path . "/" : "";

        Storage::disk("public")
            ->move("contents/" . $content->user_id . "/" . $path . $content->name, 
                   "contents/" . $content->user_id . "/" . $path . $request->title . "." . $content->extension);

        $content->name = $request->title . "." . $content->extension;
        $content->title = $request->title;
        $content->save();

        return back();
    }

    public function definition(Request $request, Content $content)
    {
        $request->validate([
            "description" => [ "string", "max:65535" ], 
        ]);

        $content->description = Str::of($request->description)->trim();
        $content->save();

        return back();
    }

    public function tags(Request $request, Content $content)
    {
        $request->validate([
            "tags" => [ "string", "max:65535" ], 
        ]);

        $content->tags = Str::of($request->tags)->trim();
        $content->save();

        return back();
    }

    public function visibility(Request $request, Content $content)
    {
        $content->visibility = $content->visibility ? false : true;
        $content->save();

        return back();
    }

    public function remove(Request $request, Content $content)
    {
        $parent = $content->folder;

        $content->remove();

        return redirect(route("folder", [ "folder" => $parent->id ]));
    }

    public function only(Request $request, Content $content)
    {
        $path = $content->path;

        $path = $path ? $path . "/" : "";

        return response()
            ->file(storage_path("app/public/contents/" . $content->user_id . "/" . $path . $content->name));
    }

    private function createBreadcrumbs(Content $content) : Collection
    {
        $breadcrumbs = new Collection();

        $breadcrumbs->put($content->title, route("content", [ "content" => $content->id ]));

        $current = $content->folder;

        if ($this->can)
        {
            while ($current)
            {
                if (!$current->folder_id)
                {
                    $breadcrumbs->put(__("page.folder.header"), route("folder", [ "folder" => $current->user->folder()->first()->id ]));
                    $breadcrumbs->put(__("page.welcome"), route("welcome"));
                }
                else 
                    $breadcrumbs->put($current->title, route("folder", [ "folder" => $current->id ]));
    
                $current = $current->folder()->first();
            }
        }
        else 
        {
            $breadcrumbs->put($content->title, route("content", [ "content" => $content->id ]));
            $breadcrumbs->put($content->user->name, route("folder", [ "folder" => $content->user->folder()->first()->id ]));
            $breadcrumbs->put(__("page.welcome"), route("welcome"));
        }

        return $breadcrumbs->reverse();
    }
}
