<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Review;

class ReviewRepository
{

    public function  __construct(private BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function paginate(int $pageSize = 10, ?string $search='') //: Collection
    {
        if ($search != '')
        {
            return Review::where('name', 'like', '%'.$search.'%')
                ->orWhere('comment', 'like', '%'.$search.'%' )
                ->paginate($pageSize);
        }
        return Review::paginate($pageSize);
    }

    public function create(array $data): ?Review
    {
        return Review::create($data);
    }

    public function update(array $updated): ?Review
    {
        $review = $this->find($updated['id']);
        if (!isset($review)) {
            return null;
        }
        $review->update($updated);
        return $review;
    }

    public function find(int $reviewId): ?Review
    {
        return Review::with('book')->find($reviewId);
    }

    public function findOrFail(int $reviewId): ?Review
    {
        return Review::with('book')->findOrFail($reviewId);
    }

    public function add(int $bookId, array $data): ?Review
    {
        $book = $this->bookRepository->find($bookId);
        if (!isset($book))
        {
            return null;
        }
        $review = $book->reviews()->create($data);
        $book->rating = $book->reviews()->avg('rating');
        $book->save();
        return $review;
    }

    public function addMany(int $bookId, array $data): ?Book
    {
        $book = $this->bookRepository->find($bookId);
        if (!isset($book))
        {
            return null;
        }
        $book->reviews()->createMany($data);
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return $book;
    }

    public function delete(int $reviewId): bool
    {
        $review = $this->find($reviewId);
        if (!isset($review))
        {
            return false;
        }
        $book = $review->book;
        $review->delete();
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return true;
    }

}
