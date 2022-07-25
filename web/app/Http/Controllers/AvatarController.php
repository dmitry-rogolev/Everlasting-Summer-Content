<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AvatarController extends Controller
{
    public function avatar(Request $request)
    {
        $request->validate([
            "avatar" => [ "required", "image", "mimes:jpg,jpeg,png,gif", "max:4096" ], 
        ]);

        $new_avatar = $request->file("avatar");
        $old_avatar = $request->user()->avatar;

        if ($old_avatar)
        {
            Storage::disk("public")->delete("avatars/" . $request->user()->id . "/" . $old_avatar->name);
            
            $old_avatar->name = $new_avatar->getClientOriginalName();
            $old_avatar->title = Str::of($new_avatar->getClientOriginalName())->beforeLast(".");
            $old_avatar->extension = $new_avatar->extension();
            $old_avatar->type = $new_avatar->getClientMimeType();
            $old_avatar->save();
        }
        else 
        {
            Avatar::create([
                "name" => $new_avatar->getClientOriginalName(), 
                "title" => Str::of($new_avatar->getClientOriginalName())->beforeLast("."), 
                "extension" => $new_avatar->extension(), 
                "type" => $new_avatar->getClientMimeType(), 
                "user_id" => $request->user()->id, 
            ]);
        }

        $new_avatar->storeAs("avatars/" . $request->user()->id, $new_avatar->getClientOriginalName(), "public");

        return back();
    }

    public function removeAvatar(Request $request, User $user)
    {
        if ($user->avatar) $user->avatar->remove();

        return back();
    }
}
