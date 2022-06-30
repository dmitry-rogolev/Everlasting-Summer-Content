<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function show(?User $current, User $user)
    {
        return optional($current)->id === $user->id;
    }

    public function visible(?User $current, User $user)
    {
        if (optional($current)->id === $user->id)
            return true;
        else 
            return boolval($user->visibility);
    }
}
