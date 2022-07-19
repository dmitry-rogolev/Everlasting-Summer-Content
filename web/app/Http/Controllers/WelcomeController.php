<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class WelcomeController extends Controller
{
    public function show(Request $request)
    {
        $this->settings(null, true);

        $breadcrumbs = new Collection([
            new Collection([
                "name" => __("page.welcome"), 
                "url" => route("welcome"), 
                __("page.welcome"), 
                route("welcome"), 
            ]), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        $sort = [ "title", "asc" ];

        if ($request->has("sort") && ($request->sort == "asc" || $request->sort == "desc"))
        {
            $sort = [ "title", $request->sort ];
        }

        return view("welcome", $this->data->merge([

            "header" => __("page.welcome"), 
            "referer" => "", 
            "sort" => $sort[1], 

            "contents" => Content::visibles()->orderBy(...$sort)->paginate(20), 

        ])
        ->all()
        );
    }
}
