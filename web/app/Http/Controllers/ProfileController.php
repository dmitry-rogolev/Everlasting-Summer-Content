<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProfileController extends ContentController
{
    public function __construct()
    {
        $breadcrumbs = new Collection([
            "Главная" => route("welcome"), 
            "Профиль" => route("profile"), 
        ]);
        parent::__construct(config("view.title"), "Профиль", url("/"), $breadcrumbs);
    }

    public function create(Request $request)
    {
        $this->theme($request);

        return view("profile", 
        [
            "title" => $this->title, 
            "header" => $this->header, 
            "referer" => $this->referer, 
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
        ]);
    }
}
