<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Author;

use App\Models\Review;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{

    public function create(array $data): ?Book
    {      
        $book = Book::create(collect($data)->except('authors')->toArray());
        if (isset($data['authors']))
        {
            $book->authors()->sync($data['authors']);           
        }
        return $book;
    }
    
    public function all(?string $search='') : Collection
    {
        // if ($search == null || $search === '') {
        //     return Book::all();
        // } else {
        //     return Book::where('title', 'like',  "%{$search}%")
        //            ->orWhere('author','like',  "%{$search}%")
        //            ->orWhere('description','like',  "%{$search}%");# code...
        // }
        return match($search) {
            '', null => Book::all(),    // Book::with(['category'])->get(), // use when Book $with property not set 
            default  => Book::where('title', 'like',  "%{$search}%")
                            ->orWhere('author','like',  "%{$search}%")
                            ->orWhere('description','like',  "%{$search}%")
        };
    }


    public function paginate(int $pageSize = 10, ?string $search=null) : LengthAwarePaginator
    {
        return match($search) {
            '',null => Book::paginate($pageSize),
            default => Book::search($search)->paginate($pageSize), 
        };
    }

    public function find(int $id): ?Book
    {
        return Book::with(['reviews','reviews.user'])->find($id);
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
        $book = $this->find($updated['id'] ?? 0);
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

    public function addReview(int $bookId, array $data): ?Review
    {
        $book = $this->find($bookId);
        if (!isset($book)) {
            return null;
        }
        $review = $book->reviews()->create($data);
        $book->rating = $book->reviews()->avg('rating');
        $book->save();
        return $review;
    }

    public function deleteReview(int $reviewId): bool
    {
        $review = Review::with('book')->find($reviewId);
        if (!isset($review)) {
            return false;
        }
        $book = $review->book;
        $review->delete();
        $book->rating = $book->reviews()->avg('rating') ?? 0;
        $book->save();
        return true;
    }


    public function addAuthorToBook(int $book_id, int $author_id) 
    {
        $book = $this->find($book_id);
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
        $book = $this->find($book_id);       
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

    public function getAuthorSelectList(?Book $book = null) 
    {      
        if ($book) {
            // make list of authors not currently associated with book 
            return Author::all()->diff($book->authors)->pluck('name','id');
        }
        // make list of all authors 
        return Author::all()->pluck('name','id');
        
    }

}
