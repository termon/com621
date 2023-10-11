<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Review;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository
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
        return match($search) {
            //'', null => Book::with(['category'])->get(), // use when Book $with property not set 
            '', null => Book::all(),
            default  => Book::search($search)
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
        return Book::with('reviews')->find($id);
    }

    public function findOrFail(int $id): ?Book
    {
        return Book::with('reviews')->findOrFail($id);
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

}
