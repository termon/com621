<?php

namespace App\Actions\Book;

use App\Models\Book;

class FindBookAction
{
    public function __construct() { }
    
    public function execute(int $id): ?Book   
    {
        return Book::with(['reviews','reviews.user'])->find($id);
    }

   
}