<?php 

namespace App\Traits;

use App\Models\Content;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

trait TView
{
    protected function view(Content $content) : bool
    {
        if (Auth::check() && !request()->user()->views()->whereContentId($content->id)->count())
        {
            View::create([
                "user_id" => request()->user()->id, 
                "content_id" => $content->id, 
            ]);

            return true;
        }
        
        return false;
    }
}
