<?php

namespace App\Actions\Review;

use App\Models\Book;
use App\Models\Review;

class DeleteReviewAction
{
    public function __construct() { }
    
    public function execute(int $reviewId): ?Book
    {
        $review = Review::with('book')->find($reviewId);
        if (!isset($review)) {
            return null;
        }
        $book = $review->book;
        $review->delete();
        $book->rating = $book->reviews()->avg('rating') ?? 0;       
        $book->save();
        return $book;
    }
   
}