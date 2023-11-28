<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Author;
use App\Models\Review;

class BookService
{

    public function createBook(array $data): ?Book
    {    
        $book = Book::create(collect($data)->except('authors')->toArray());
        if (isset($data['authors']))
        {
            $book->authors()->sync($data['authors']);           
        }
        return $book;
    }
    
    public function searchBooks(?string $search='') //: \Illuminate\Database\Eloquent\Builder 
    {
        return Book::with(['category'])->search($search);
    }

    public function findBook(int $id): ?Book
    {
        return Book::with(['reviews','reviews.user'])->find($id);
    }

    public function deleteBook(int $id): bool
    {
        $book = $this->findBook($id);
        if ($book) {
            $book->delete();
            return true;
        }
        return false;
    }

    public function deleteAllBooks(): void
    {
        $books = Book::all();
        foreach($books as $book) {
            $book->delete();
        }
    }

    public function updateBook(int $id, array $updated): ?Book
    {
        $book = $this->findBook($id);
        if ($book) {
            $book->update(collect($updated)->except('id','authors')->toArray());
            //$book->update(collect($updated)->only('title','year','rating','description','image','category_id')->toArray());
            if (isset($updated['authors']))
            {
                $book->authors()->sync($updated['authors']);           
            }
            return $book;
        }
        return null;
    }

    // ===================== Review Management =========================

    public function findReview(int $reviewId): ?Review
    {
        return Review::with('book')->find($reviewId);
    }

    public function addReviewToBook(int $bookId, array $data): ?Review
    {
        $book = $this->findBook($bookId);
        if (!isset($book)) {
            return null;
        }
        $data['reviewed_on'] = now();
        $review = $book->reviews()->create($data);
        $book->rating = $book->reviews()->avg('rating');
        $book->save();
        return $review;
    }

    public function deleteReviewFromBook(int $reviewId): ?Book
    {
        $review = $this->findReview($reviewId);
        if (!isset($review)) {
            return null;
        }
        $book = $review->book;
        $review->delete();
        $book->rating = $book->reviews()->avg('rating') ?? 0;       
        $book->save();
        return $book;
    }

    // =============== BookAuthor Mangement ===========================
    
    public function addAuthorToBook(int $book_id, int $author_id) 
    {
        $book = $this->findBook($book_id);
        $author = Author::find($author_id);

        if (isset($book) && isset($author)) {
            // option 1
            $book->authors()->attach($author);

            // option 2
            // $book->authors()->sync([
            //      'author_id' => $data['author_id'],
            //      'book_id' => $id
            // ]);

            // option 3
            // $author_ids = $book->authors->pluck('id');
            // $author_ids->push($author_id);
            // $book->authors()->sync($author_ids);
           
            return $book;
        }
        return null;
    }
    public function removeAuthorFromBook(int $book_id, int $author_id) 
    {
        $book = $this->findBook($book_id);       
        $author = Author::find($author_id);
       
        if (isset($book) && isset($author)) {
            // option 1
            $book->authors()->detach($author);

            // option 2
            // $author_ids = $book->authors->pluck('id')
            //         ->filter(fn(int $value) => $value != $author_id);
            // $book->authors()->sync($author_ids);

            return $book;
        }
        return null;
    }

}
