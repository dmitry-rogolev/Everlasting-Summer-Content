<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class WelcomeController extends ContentController
{
    public function __construct()
    {
        $breadcrumbs = new Collection([
            "Главная" => url("/"), 
        ]);

        parent::__construct(config("view.title"), "Главная", "", $breadcrumbs);
    }

    public function show(Request $request)
    {
        $this->theme($request);

        return view("welcome", [
            "title" => $this->title, 
            "header" => $this->header, 
            "referer" => $this->referer, 
            "theme" => $this->theme, 
            "breadcrumbs" => $this->breadcrumbs, 
        ]);
    }
}
