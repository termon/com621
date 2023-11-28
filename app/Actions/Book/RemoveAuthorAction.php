<?php

namespace App\Actions\Book;

use App\Models\Book;
use App\Models\Author;

class RemoveAuthorAction
{
    public function __construct() { }
    
    public function execute(int $book_id, int $author_id): ?Book 
    {
        $book = Book::find($book_id);       
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