<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\User;
use App\Models\Review;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * Called before any authorisation function and thus can shortcircuit
     */
    public function before(User $user, string $ability): bool|null
    {
        return ($user->role == Role::ADMIN) ? true : null;        
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
       return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Review $review): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {              
        return $user->role == Role::GUEST;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->id == $review->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Review $review): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Review $review): bool
    {
        //
       
        return false;
    }
}
