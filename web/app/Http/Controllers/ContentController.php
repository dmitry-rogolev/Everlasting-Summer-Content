<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function show(Request $request, string $title)
    {
        $this->settings(null, true);

        $content = $request->user()->contents()->whereTitle($title)->first();
        
        if (!$content) abort(404);

        $breadcrumbs = new Collection([
            __("page.welcome") => route("welcome"), 
            __("page.my-content.header") => route("my-content"), 
            $content->title => route("my-content.content", [ "content" => $title ]), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        return view("content", 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 

            "header" => $content->title, 
            "referer" => route("my-content"), 

            "content" => $content, 

            "rename" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.content.renaming"), 
            ]), 

            "remove" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.content.removing"), 
            ]), 
        ]);
    }

    public function rename(Request $request, string $title)
    {
        $request->validate([
            "title" => [ "required", "string", "max:255" ], 
        ]);

        $content = $request->user()->contents()->whereTitle($title)->first();

        if (!$content) 
            back()->withErrors(["title" => __("page.content.no-exists", [ "title" => $title ])]);

        if ($request->user()->contents()->whereTitle($request->title)->first())
            return back()->withErrors(["title" => __("page.content.exists", [ "title" => $request->title ])]);
        
        $content->title = $request->title;
        $content->save();

        return redirect(route("my-content.content", [ "content" => $content->title ]));
    }

    public function remove(Request $request, string $title)
    {
        $content = $request->user()->contents()->whereTitle($title)->first();

        if (!$content) 
            back()->withErrors(["title" => __("page.content.no-exists", [ "title" => $title ])]);

        if ($content)
        {
            Storage::disk("public")
                ->delete("contents/" . $request->user()->id . "/" . $content->hash . "." . $content->extension);

            $content->delete();
        }

        return redirect(route("my-content"));
    }
}
