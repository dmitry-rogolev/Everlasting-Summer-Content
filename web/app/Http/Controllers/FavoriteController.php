<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Favorite;
use App\Traits\TSort;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    use TSort;

    public function show(Request $request)
    {
        $this->settings();

        $breadcrumbs = $this->breadcrumbs([
            __("page.welcome") => route("welcome"), 
            __("page.favorite.favorite") => route("favorite"), 
        ]);

        $this->setBreadcrumbs($breadcrumbs);

        $sort = $this->sort("title");

        $contents = $request->user()->favorites();

        return view("favorite", $this->data->merge([

            "header" => $breadcrumbs->last()->get("name"), 
            "referer" => $breadcrumbs->reverse()->skip(1)->first()->get("url"), 
            "sort" => $contents->count() ? $sort[1] : false, 

            "contents" => $contents->paginate(20), 

        ])
        ->all()
        );
    }

    public function favorite(Request $request, Content $content)
    {
        $favorites = $request->user()->favorites()->whereContentId($content->id);

        if ($favorites->count())
            $favorites->delete();
        else 
        {
            Favorite::create([
                "user_id" => $request->user()->id, 
                "content_id" => $content->id, 
            ]);
        }

        return back();
    }
}
