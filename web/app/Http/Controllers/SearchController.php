<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $this->settings(null, true);

        $request->validate([
            "search" => [ "required", "string", "max:255" ], 
        ]);

        $breadcrumbs = new Collection([
            new Collection([
                "name" => __("page.welcome"), 
                "url" => route("welcome"), 
                __("page.welcome"), 
                route("welcome"), 
            ]), 
            new Collection([
                "name" => __("page.search.search"), 
                "url" => route("search"), 
                __("page.search.search"), 
                route("search"), 
            ]), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        return view("search", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "search" => $request->search, 

            "contents" => Content::search($request->search)->where("visibility", true)->paginate(20), 

        ])
        ->all()
        );
    }
}
