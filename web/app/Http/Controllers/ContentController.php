<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Dislike;
use App\Models\Download;
use App\Models\Favorite;
use App\Models\Folder;
use App\Models\Like;
use App\Models\User;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    protected Content $content;

    protected User $user;

    protected bool $can;

    public function show(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        $this->settings(null, true);

        $this->content = $content;

        $this->can = $this->can($content);

        $this->authorize("visible", $content);

        $this->user = $this->can ? $request->user() : $user;

        $breadcrumbs = $this->breadcrumbs($folders);

        $path = $folders->reverse()->skip(1)->reverse()->implode("/");

        $this->view();

        return view("content", $this->data->merge([

            "header" => $content->title, 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "path" => $path, 
            "can" => $this->can, 
            "user" => $this->user, 

            "content" => $content, 

            "rename" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]), 

            "tags" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),

            "remove" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
            ]),

            "visibility" => new Collection([
                "header" => $content->visibility ? __("page.my.public") : __("page.my.private"),
                "title" => $content->visibility ? __("page.my.private-text") : __("page.my.public-text"), 
            ]),

            "like" => boolval($user->likes()->whereContentId($content->id)->count()), 

            "dislike" => boolval($user->dislikes()->whereContentId($content->id)->count()), 

            "favorite" => boolval($user->favorites()->whereContentId($content->id)->count()), 

        ])
        ->all()
        );
    }

    public function rename(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        if (!$this->can($content)) abort(404);

        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        if ($parent->contents()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.content.exists", [ "title" => $request->title ]) ]);
        
        else if ($parent->folders()->whereTitle($request->title)->first())
            return back()->withErrors([ "title" => __("page.my.used", [ "title" => $request->title ]) ]);
        
        $path = $folders->reverse()->skip(1)->reverse()->implode("/");

        Storage::disk("public")
            ->move("contents/" . $request->user()->id . "/" . ($path ? $path . "/" : $path) . $content->title . "." . $content->extension, 
                   "contents/" . $request->user()->id . "/" . ($path ? $path . "/" : $path) . $request->title . "." . $content->extension);

        $content->title = $request->title;
        $content->save();

        return redirect(url($request->user()->id . "/" . ($path ? $path . "/" : $path) . $request->title));
    }

    public function tags(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        if (!$this->can($content)) abort(404);

        $request->validate([
            "tags" => [ "string", "max:65535" ], 
        ]);

        $content->tags = $request->tags;
        $content->save();

        return back();
    }

    public function remove(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        if (!$this->can($content)) abort(404);

        $path = $folders->reverse()->skip(1)->reverse()->implode("/");

        Storage::disk("public")
            ->move("contents/" . $request->user()->id . "/" . ($path ? $path . "/" : $path) . $content->title . "." . $content->extension, 
                   "../deletes/contents/" . $request->user()->id . "/" . ($path ? $path . "/" : $path) . $content->title . "." . $content->extension);

        $content->delete();

        return redirect(url($request->user()->id . "/" . $path));
    }

    public function download(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        if (Auth::check() && !$request->user()->downloads()->whereContentId($content->id)->count())
        {
            Download::create([
                "user_id" => $request->user()->id, 
                "content_id" => $content->id, 
            ]);
        }
        
        $path = $folders->reverse()->skip(1)->reverse()->implode("/");

        return Storage::download("public/contents/" . $user->id . "/" . ($path ? $path . "/" : "") . $content->title . "." . $content->extension);
    }

    public function visibility(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        if (!$this->can($content)) abort(404);

        $content->visibility = $content->visibility ? false : true;
        $content->save();

        return back();
    }

    public function like(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        $likes = $request->user()->likes()->whereContentId($content->id);

        if ($likes->count())
        {
            $likes->delete();
        }
        else 
        {
            $dislikes = $request->user()->dislikes()->whereContentId($content->id);

            if ($dislikes->count())
                $dislikes->delete();

            Like::create([
                "user_id" => $request->user()->id, 
                "content_id" => $content->id, 
            ]);
        }

        return back();
    }

    public function dislike(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        $dislikes = $request->user()->dislikes()->whereContentId($content->id);
        if ($dislikes->count())
        {
            $dislikes->delete();
        }
        else 
        {
            $likes = $request->user()->likes()->whereContentId($content->id);

            if ($likes->count())
                $likes->delete();
            
            Dislike::create([
                "user_id" => $request->user()->id, 
                "content_id" => $content->id, 
            ]);
        }

        return back();
    }

    public function favorite(Request $request, User $user, Folder|User $parent, Collection $folders, Content $content)
    {
        $favorites = $request->user()->favorites()->whereContentId($content->id);

        if ($favorites->count())
        {
            $favorites->delete();
        }
        else 
        {
            Favorite::create([
                "user_id" => $request->user()->id, 
                "content_id" => $content->id, 
            ]);
        }

        return back();
    }

    protected function view()
    {
        if (Auth::check())
        {
            $user = request()->user();
            $content = $this->content;
            
            $views = $user->views()->whereContentId($content->id);

            if (!$views->count())
            {
                View::create([
                    "user_id" => $user->id, 
                    "content_id" => $content->id, 
                ]);
            }
        }
    }

    protected function can(Content $content)
    {
        if (Auth::check()) 
        {
            return request()->user()->can("show", $content);
        }
        else 
        {
            return false;
        }
    }

    protected function breadcrumbs(Collection $folders)
    {
        if ($this->can)
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
        }
        else 
        {
            $breadcrumbs = new Collection([
                new Collection([
                    "name" => __("page.welcome"), 
                    "url" => route("welcome"), 
                    __("page.welcome"), 
                    route("welcome"), 
                ]), 
            ]);
        }
        
        $path = "";
        if ($this->can)
        {
            $f = $this->user;
            foreach ($folders->reverse()->skip(1)->reverse() as $folder)
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
        $breadcrumbs->push(new Collection([
            "name" => $this->content->title, 
            "url" => url($this->user->id . "/" . ($path ? $path . "/" : $path) . $this->content->title), 
            $this->content->title, 
            url($this->user->id . "/" . ($path ? $path . "/" : $path) . $this->content->title), 
        ]));

        parent::breadcrumbs($breadcrumbs);

        return $breadcrumbs;
    }
}
