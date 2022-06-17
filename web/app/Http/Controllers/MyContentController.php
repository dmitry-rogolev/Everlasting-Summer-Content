<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MyContentController extends Controller
{
    public function show(Request $request)
    {
        $this->settings(null, true);

        $breadcrumbs = new Collection([
            __("page.welcome") => route("welcome"), 
            __("page.my-content.header") => route("my-content"), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        return view("my-content", 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 

            "header" => __("page.my-content.header"), 
            "referer" => url("/"), 

            "add" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.my-content.add"), 
            ]), 

            "contents" => $request->user()->contents()->orderBy("title")->get(), 
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            "title" => [ "max:255" ], 
            "file" => [ "required", "file", "mimes:jpg,jpeg,png,gif", "max:51200" ], 
        ]);

        $file = $request->file("file");

        $name = Str::of($file->getClientOriginalName())->beforeLast(".");

        if ($request->title && $request->user()->contents()->whereTitle($request->title)->first())
            return back()->withErrors(["title" => __("page.content.exists", [ "title" => $request->title ])]);
        
        if (!$request->title && $request->user()->contents()->whereTitle($name)->first()) 
            return back()->withErrors(["title" => __("page.content.exists", [ "title" => $name ])]);

        Content::create([
            "title" => $request->title ?? $name, 
            "name" => $name, 
            "hash" => Str::of($file->hashName())->beforeLast("."), 
            "extension" => $file->extension(), 
            "type" => $file->getClientMimeType(), 
            "user_id" => $request->user()->id, 
        ]);

        $file->storeAs("contents/" . $request->user()->id, $file->hashName(), "public");

        return back();
    }
}
