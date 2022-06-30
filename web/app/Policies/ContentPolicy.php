<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function show(?User $user, Content $content)
    {
        return optional($user)->id === $content->user_id;
    }

    public function visible(?User $user, Content $content)
    {
        if (optional($user)->id === $content->user_id) return true;
        else return boolval($content->visibility);
    }
}
