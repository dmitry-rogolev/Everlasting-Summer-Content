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

    public function show(?User $user, Folder $folder)
    {
        return optional($user)->id === $folder->user_id;
    }

    public function remove(?User $user, Folder $folder)
    {
        return optional($user)->id === $folder->user_id;
    }

    public function removeRootFolder(?User $user, Folder $folder)
    {
        return optional($user)->id === $folder->user_id && $folder->folder_id;
    }

    public function visible(?User $user, Folder $folder)
    {
        if ($this->show($user, $folder)) return true;
        
        return !$folder->folder_id && $folder->visibility;
    }
}
