<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Dislike;
use Illuminate\Http\Request;

class DislikeController extends Controller
{
    public function dislike(Request $request, Content|Comment $model)
    {
        if ($model instanceof Content)
            return $this->dislikeContent($model);

        else if ($model instanceof Comment)
            return $this->dislikeComment($model);

        return back();
    }

    private function dislikeContent(Content $content)
    {
        $dislikes = request()->user()->dislikes()->whereContentId($content->id);

        if ($dislikes->count())
            $dislikes->delete();
        else 
        {
            $likes = request()->user()->likes()->whereContentId($content->id);

            if ($likes->count())
                $likes->delete();
            
            Dislike::create([
                "user_id" => request()->user()->id, 
                "content_id" => $content->id, 
            ]);
        }

        return back();
    }

    private function dislikeComment(Comment $comment)
    {
        $dislikes = request()->user()->dislikes()->whereCommentId($comment->id);
        
        if ($dislikes->count())
            $dislikes->delete();
        else 
        {
            $likes = request()->user()->likes()->whereCommentId($comment->id);

            if ($likes->count())
                $likes->delete();
            
            Dislike::create([
                "user_id" => request()->user()->id, 
                "comment_id" => $comment->id, 
            ]);
        }

        return back();
    }
}
