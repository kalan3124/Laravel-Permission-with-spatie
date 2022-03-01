<?php

namespace App\Policies;

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

    public function edit(User $user)
    {
        if ($user->can('edit posts')) {
            return true;
        }
    }

    public function delete(User $user)
    {
        if ($user->can('delete posts')) {
            return true;
        }
    }
}
