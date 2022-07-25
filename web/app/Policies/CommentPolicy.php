<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(?User $user, Comment $comment)
    {
        return optional($user)->id == $comment->user_id;
    }

    public function remove(?User $user, Comment $comment)
    {
        return optional($user)->id == $comment->user_id;
    }
}
