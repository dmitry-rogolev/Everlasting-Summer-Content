<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->settings($request);

        Navigation::cache();

        $breadcrumbs = new Collection([
            __("page.welcome") => route("welcome"), 
            __("page.profile.header") => route("profile"), 
        ]);

        Cache::put("breadcrumbs", $breadcrumbs);

        $avatar = $request->user()->avatar;
        
        return view("profile", 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 

            "header" => __("page.profile.header"), 
            "referer" => url("/"), 
            "avatar" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.profile.avatar.header"), 
                "path" => $avatar && Storage::disk("public")->exists("avatars/" . $request->user()->id . "_" . $avatar->hash . "." . $avatar->extension) 
                    ? "../storage/avatars/" . $request->user()->id . "_" . $avatar->hash . "." . $avatar->extension 
                    : "",  
            ]), 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "avatar" => [ "required", "image", "mimes:jpg,jpeg,png,gif", "max:4096" ], 
        ]);

        $this->avatar();

        return back();
    }

    private function avatar()
    {
        $new_avatar = request()->file("avatar");
        $old_avatar = request()->user()->avatar;

        if ($old_avatar)
        {
            Storage::disk("public")->delete("avatars/" . request()->user()->id . "_" . $old_avatar->hash . "." . $old_avatar->extension);
            
            $old_avatar->name = Str::of($new_avatar->getClientOriginalName())->beforeLast(".");
            $old_avatar->hash = Str::of($new_avatar->hashName())->beforeLast(".");
            $old_avatar->extension = $new_avatar->extension();
            $old_avatar->type = $new_avatar->getClientMimeType();
            $old_avatar->save();
        }
        else 
        {
            Avatar::create([
                "name" => Str::of($new_avatar->getClientOriginalName())->beforeLast("."), 
                "hash" => Str::of($new_avatar->hashName())->beforeLast("."), 
                "extension" => $new_avatar->extension(), 
                "type" => $new_avatar->getClientMimeType(), 
                "user_id" => request()->user()->id, 
            ]);
        }

        $new_avatar->storeAs("avatars", request()->user()->id . "_" . $new_avatar->hashName(), "public");
    }
}
