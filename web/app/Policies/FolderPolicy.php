<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
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

    public function show(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }

    public function addContent(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }

    public function createFolder(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }

    public function rename(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }

    public function remove(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}
