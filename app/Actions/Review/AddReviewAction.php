<?php

namespace App\Actions\Review;

use App\Models\Book;
use App\Models\Review;
use App\Data\ReviewData;

class AddReviewAction
{
    public function __construct() { }
    
    public function execute(int $bookId, ReviewData $data): ?Review
    {
        $book = Book::find($bookId);
        if (!isset($book)) {
            return null;
        }
        $data->reviewed_on = now();
        $review = $book->reviews()->create($data->toArray());
        $book->rating = $book->reviews()->avg('rating');
        $book->save();
        return $review;
    }
   
}