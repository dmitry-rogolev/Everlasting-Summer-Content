<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
        ]);
    }
}
