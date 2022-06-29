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

        return view("welcome", $this->data->merge([

            "header" => __("page.welcome"), 
            "referer" => "", 

            "contents" => Content::all()->shuffle(), 

        ])
        ->all()
        );
    }
}
