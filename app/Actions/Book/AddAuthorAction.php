<?php

namespace App\Actions\Book;

use App\Models\Book;
use App\Models\Author;

class AddAuthorAction
{
    public function __construct() { }
    
    public function execute(int $book_id, int $author_id): ?Book 
    {
        $book = Book::find($book_id);
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
   
}