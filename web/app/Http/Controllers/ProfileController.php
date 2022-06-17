<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Rules\User;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $this->settings(null, true);

        $breadcrumbs = new Collection([
            __("page.welcome") => route("welcome"), 
            __("page.profile.header") => route("profile"), 
        ]);

        $this->breadcrumbs($breadcrumbs);

        $avatar = $request->user()->avatar;

        return view("profile", 
        [
            "theme" => $this->theme, 
            "themes" => $this->themes, 
            "inversion_themes" => $this->inversionThemes, 
            "title" => $this->title, 
            "lang" => $this->lang, 
            "request" => $request, 

            "header" => __("page.profile.header"), 
            "referer" => url("/"), 
            "avatar" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.profile.avatar"), 
                "path" => 
                    $avatar && Storage::disk("public")->exists("avatars/" . $request->user()->id . "_" . $avatar->hash . "." . $avatar->extension) 
                    ? "../storage/avatars/" . $request->user()->id . "_" . $avatar->hash . "." . $avatar->extension 
                    : "", 
            ]), 
            "name" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.profile.name"), 
            ]), 
            "email" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.profile.email"), 
            ]), 
            "password" => new Collection([
                "id" => id(), 
                "labelledby" => id(), 
                "header" => __("page.profile.changing-password"), 
            ]), 
            "my_content" => new Collection([
                "header" => __("page.my-content.header"), 
                "href" => route("my-content"), 
            ]), 
        ]);
    }

    public function avatar(Request $request)
    {
        $request->validate([
            "avatar" => [ "required", "image", "mimes:jpg,jpeg,png,gif", "max:4096" ], 
        ]);

        $new_avatar = $request->file("avatar");
        $old_avatar = $request->user()->avatar;

        if ($old_avatar)
        {
            Storage::disk("public")->delete("avatars/" . $request->user()->id . "_" . $old_avatar->hash . "." . $old_avatar->extension);
            
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
                "user_id" => $request->user()->id, 
            ]);
        }

        $new_avatar->storeAs("avatars", $request->user()->id . "_" . $new_avatar->hashName(), "public");

        return back();
    }

    public function name(Request $request)
    {
        $request->validate([
            "name" => [ "required", "string", "max:255" ], 
        ]);

        $user = $request->user();
        $user->name = $request->name;
        $user->save();

        return back();
    }

    public function email(Request $request)
    {
        $request->validate([
            "email" => [ "required", "string", "email", "max:255", new User\Unique() ], 
        ]);

        $user = $request->user();
        $user->email = $request->email;
        $user->save();

        event(new Registered($user));

        return back();
    }

    public function password(Request $request)
    {
        $request->validate([
            "old_password" => [ "required", Rules\Password::defaults() ], 
            "password" => [ "required", "confirmed", Rules\Password::defaults() ]
        ]);

        if (!Hash::check($request->old_password, $request->user()->password))
            back()->withErrors(["old_password" => __("auth.errors.password")]);
        
        $user = $request->user();
        
        $user->password = Hash::make($request->password);
        $user->save();

        return back();
    }
}
