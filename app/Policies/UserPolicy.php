<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can be updated by the current user.
     *
     * @param  \App\Models\User  $currentUser
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->hasPermission('users', 'update');
    }
}
