<?php

namespace App\Actions\Book;

use App\Models\Book;

class DeleteBookAction
{
    public function __construct() { }
    
    public function execute(int $id): bool    
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return true;
        }
        return false;
    }
  
}