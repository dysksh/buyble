<?php

namespace App\Policies;

use App\Textbook;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TextbookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any textbooks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the textbook.
     *
     * @param  \App\User  $user
     * @param  \App\Textbook  $textbook
     * @return mixed
     */
    public function view(User $user, Textbook $textbook)
    {
        //
    }

    /**
     * Determine whether the user can create textbooks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id !== 1;
    }

    /**
     * Determine whether the user can update the textbook.
     *
     * @param  \App\User  $user
     * @param  \App\Textbook  $textbook
     * @return mixed
     */
    public function update(User $user, Textbook $textbook)
    {
        return $user->id === $textbook->seller_id || $user->id === 1;
    }

    /**
     * Determine whether the user can delete the textbook.
     *
     * @param  \App\User  $user
     * @param  \App\Textbook  $textbook
     * @return mixed
     */
    public function delete(User $user, Textbook $textbook)
    {
        return $user->id === $textbook->seller_id || $user->id === 1;
    }

    /**
     * Determine whether the user can restore the textbook.
     *
     * @param  \App\User  $user
     * @param  \App\Textbook  $textbook
     * @return mixed
     */
    public function restore(User $user, Textbook $textbook)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the textbook.
     *
     * @param  \App\User  $user
     * @param  \App\Textbook  $textbook
     * @return mixed
     */
    public function forceDelete(User $user, Textbook $textbook)
    {
        //
    }
}
