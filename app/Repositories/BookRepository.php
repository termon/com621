<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\BookData;

use App\Models\Review;
use App\Models\ReviewData;

use Illuminate\Support\Collection;

class BookRepository
{

    public function create(array $data): ?Book
    {
        return Book::create($data);
    }

    public function all(?string $search='') //: Collection
    {
        if ($search != '')
        {
            return Book::where('title', 'like', '%'.$search.'%')
                        ->orWhere('author', 'like', '%'.$search.'%' );
        }
        return Book::all();
    }

    public function paged(int $pageSize = 10, ?string $search='') //: Collection
    {
        if ($search != '')
        {
            return Book::where('title', 'like', '%'.$search.'%')
                ->orWhere('author', 'like', '%'.$search.'%' )
                ->paginate($pageSize);
        }
        return Book::paginate($pageSize);
    }

    public function find(int $id): ?Book
    {
        return Book::with('reviews')->find($id);
    }

    public function delete(int $id): bool
    {
        $book = $this->find($id);
        if ($book) {
            $book->delete();
            return true;
        }
        return false;
    }

    public function deleteAll(): void
    {
        $books = Book::all();
        foreach($books as $book) {
            $book->delete();
        }
    }

    public function update(array $updated): ?Book
    {
        $book = $this->find($updated['id']);
        if ($book) {
            $book->update($updated);
            return $book;
        }
        return null;
    }


    public function findReview(int $id): ?Review
    {
        return Review::with('book')->find($id);
    }

    public function addReview(int $bookId,array $data): ?Review
    {
        $book = $this->find($bookId);
        $review =  $book->reviews()->create($data);
        $book->rating = $book->reviews()->avg('rating');
        $book->save();
        return $review;
    }

    public function addReviews(int $bookId, array $data): ?Book
    {
        $book = $this->find($bookId);
        $book->reviews()->createMany($data);
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return $book;
    }

    public function deleteReview(int $reviewId): bool
    {
        $review = Review::with('book')->find($reviewId);
        $book = $review->book;
        $review->delete();
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return true;
    }

}
