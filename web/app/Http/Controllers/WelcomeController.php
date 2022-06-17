<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class WelcomeController extends Controller
{
    public function show(Request $request)
    {
        $this->settings(null, true);

        $breadcrumbs = new Collection([
            __("page.welcome") => url("/"), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        return view("welcome", [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 
            
            "header" => __("page.welcome"), 
            "referer" => "", 
        ]);
    }
}
