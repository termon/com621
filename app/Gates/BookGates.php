<?php
namespace App\Gates;

use App\Enums\Role;
use App\Models\User;
use App\Models\Review;

class BookGates {

    public function isAuthor(User $user) {
        return $user->role == Role::AUTHOR;
    }

    public function manageReview(User $user, Review $review) {
        return $user->id === $review->user_id || $user->role == Role::ADMIN;       
    }
}