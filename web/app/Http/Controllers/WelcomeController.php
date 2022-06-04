<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class WelcomeController extends ContentController
{
    public function __construct()
    {
        $breadcrumbs = new Collection([
            __("page.welcome") => url("/"), 
        ]);

        parent::__construct(config("view.title"), __("page.welcome"), "", $breadcrumbs);
    }

    public function show(Request $request)
    {
        $this->theme($request);

        return view("welcome", [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "header" => $this->header, 
            "referer" => $this->referer, 
            "breadcrumbs" => $this->breadcrumbs, 
        ]);
    }
}
