<?php

namespace App\Policies;

use App\Models\Forum;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Forum $forum)
    {
        return $user->id == $forum->manager_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\User $user
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Forum $forum)
    {
        return $user->id == $forum->manager_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\User $user
     * @param \App\Models\Forum $forum
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Forum $forum)
    {
        return false;
    }

}
