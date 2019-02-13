<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\Roles\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function create(User $user)
    {
        return $user->hasRole(Role::AUTHOR);
    }

    public function updateAndDelete(User $user, Post $post)
    {
        return $user->hasRole(Role::MODERATOR) || ($user->hasRole(Role::AUTHOR) && $user->id === $post->user_id);
    }
}
