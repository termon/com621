<?php

namespace App\Actions\Book;

use App\Data\BookData;
use App\Models\Book;

class CreateBookAction
{
    public function __construct() { }
    
    // public function execute(array $data): ?Book    
    // {    
    //     $book = Book::create(collect($data)->except('authors')->toArray());
    //     if (isset($data['authors']))
    //     {
    //         $book->authors()->sync($data['authors']);           
    //     }
    //     return $book;
    // }
    
    public function execute(BookData $data): ?Book    
    {    
        $book = Book::create([                
                'title' => $data->title,
                'year' => $data->year,
                'rating' => $data->rating,
                'category_id' => $data->category_id,
                'description' => $data->description, 
                'image' => $data->image               
        ]);
       

        if (isset($data->authors))
        {
            $book->authors()->sync($data->authors);           
        }
        return $book;
    }
       
}