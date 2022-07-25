<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Traits\TSort;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    use TSort;

    public function show(Request $request)
    {
        $this->settings();

        $request->validate([
            "search" => [ "required", "string", "max:255" ], 
        ]);

        $breadcrumbs = $this->breadcrumbs([
            __("page.welcome") => route("welcome"), 
            __("page.search.search") => route("search"), 
        ]);

        $this->setBreadcrumbs($breadcrumbs);

        $sort = $this->sort("title");

        return view("search", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "search" => $request->search, 
            "sort" => $sort[1], 

            "contents" => Content::search($request->search)->where("visibility", true)->orderBy(...$sort)->paginate(20), 

        ])
        ->all()
        );
    }
}
