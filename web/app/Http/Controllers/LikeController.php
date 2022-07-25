<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request, Content|Comment $model)
    {
        if ($model instanceof Content)
            return $this->likeContent($model);

        else if ($model instanceof Comment)
            return $this->likeComment($model);

        return back();
    }

    private function likeContent(Content $content)
    {
        $likes = request()->user()->likes()->whereContentId($content->id);

        if ($likes->count())
            $likes->delete();
        else 
        {
            $dislikes = request()->user()->dislikes()->whereContentId($content->id);

            if ($dislikes->count())
                $dislikes->delete();

            Like::create([
                "user_id" => request()->user()->id, 
                "content_id" => $content->id, 
            ]);
        }

        return back();
    }

    private function likeComment(Comment $comment)
    {
        $likes = request()->user()->likes()->whereCommentId($comment->id);

        if ($likes->count())
            $likes->delete();
        else 
        {
            $dislikes = request()->user()->dislikes()->whereCommentId($comment->id);

            if ($dislikes->count())
                $dislikes->delete();

            Like::create([
                "user_id" => request()->user()->id, 
                "comment_id" => $comment->id, 
            ]);
        }

        return back();
    }
}
