<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Review;
use App\Data\ReviewData;

class ReviewService
{

    public function  __construct(private BookService $bookService) {}

    public function searchReviews(int $pageSize = 10, ?string $search='') //: Collection
    {
        if ($search != '')
        {
            return Review::where('name', 'like', '%'.$search.'%')
                ->orWhere('comment', 'like', '%'.$search.'%' )
                ->paginate($pageSize);
        }
        return Review::paginate($pageSize);
    }

    public function updateReview(ReviewData $updated): ?Review
    {
        $review = $this->findReview($updated->id);
        if (!isset($review)) {
            return null;
        }
        $review->update($updated->toArray());
        return $review;
    }

    public function findReview(int $reviewId): ?Review
    {
        return Review::with('book')->find($reviewId);
    }

    public function addReview(int $bookId, ReviewData $data): ?Review
    {
        $book = $this->bookService->findBook($bookId);
        if (!isset($book))
        {
            return null;
        }       
        $review = $book->reviews()->create($data->toArray());
        $book->rating = $book->reviews()->avg('rating');
        $book->save();
        return $review;
    }

    public function addManyReviews(int $bookId, array $data): ?Book
    {
        $book = $this->bookService->findBook($bookId);
        if (!isset($book))
        {
            return null;
        }
        $book->reviews()->createMany($data);
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return $book;
    }

    public function deleteReview(int $reviewId): ?Book
    {
        $review = $this->findReview($reviewId);
        if (!isset($review))
        {
            return false;
        }
        $book = $review->book;
        $review->delete();
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return $book;
    }

}
