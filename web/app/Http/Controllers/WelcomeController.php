<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Traits\TSort;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    use TSort;

    public function show(Request $request)
    {
        $this->settings();

        $breadcrumbs = $this->breadcrumbs([
            __("page.welcome") => route("welcome"), 
        ]);

        $this->setBreadcrumbs($breadcrumbs);

        $sort = $this->sort("title");

        $contents = Content::visibles()->orderBy(...$sort);

        return view("welcome", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => false, 
            "sort" => $contents->count() ? $sort[1] : false, 

            "contents" => $contents->paginate(20), 

        ])
        ->all()
        );
    }
}
