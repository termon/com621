<?php

namespace App\Actions\Book;

use App\Models\Book;

class SearchBooksAction
{
    public function __construct() { }
    
    public function execute(?string $search=''): mixed // Illuminate\Database\Eloquent\Builder   
    {
        return Book::with(['category'])->search($search);
    }

   
}