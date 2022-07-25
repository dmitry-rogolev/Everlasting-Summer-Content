<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Dislike;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function comment(Request $request, Content $content, ?Comment $comment = null)
    {
        $request->validate([
            "comment" => [ "string", "required", "max:65535" ], 
        ]);

        Comment::create([
            "comment" => $request->comment, 
            "comment_id" => $comment ? $comment->id : null, 
            "content_id" => $content->id, 
            "user_id" => $request->user()->id, 
        ]);

        return back();
    }

    public function change(Request $request, Comment $comment)
    {
        $request->validate([
            "comment" => [ "required", "string", "max:65535" ], 
        ]);

        $comment->comment = Str::of($request->comment)->trim();
        $comment->save();

        return back();
    }

    public function remove(Request $request, Comment $comment)
    {
        $comment->remove();

        return back();
    }
}
