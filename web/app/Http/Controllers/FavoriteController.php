<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Content;

class FavoriteController extends Controller
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
            new Collection([
                "name" => __("page.favorite.favorite"), 
                "url" => route("favorite"), 
                __("page.favorite.favorite"), 
                route("favorite"), 
            ]), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        return view("favorite", $this->data->merge([

            "header" => __("page.favorite.favorite"), 
            "referer" => route("welcome"), 

            "contents" => $request->user()->favorites()->paginate(20), 

        ])
        ->all()
        );
    }
}
