<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{

    // Short-Circuits other policy methods if user is an ADMIN
    public function before(User $user, string $ability): bool|null
    {
        return ($user->role == Role::ADMIN) ? true : null;        
    }
   
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {   
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool //, Book $book): bool
    {
        return false; // true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role == Role::AUTHOR;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user) //, Book $book): bool
    {
        return $user->role == Role::AUTHOR;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return true;
    }
}
