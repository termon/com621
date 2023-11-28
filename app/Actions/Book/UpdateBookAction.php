<?php

namespace App\Actions\Book;

use App\Models\Book;
use App\Data\BookData;
use App\Actions\Book\FindBookAction;

class UpdateBookAction
{
    // example where we inject other actions to be used in this action
    public function __construct(
        public FindBookAction $findAction
    ) { }
    
    public function execute(int $id, BookData $updated): ?Book    
    {
        $book = $this->findAction->execute($id);
        if ($book) {
            $book->update(
                $updated->toArray() //->toCollection()->only('title','year','rating','description','image','category_id')->toArray()
            );    

            if (isset($updated->authors))
            {
                $book->authors()->sync($updated->authors);           
            }
            return $book;
        }
        return null;
    }

    public function execute1(array $updated): ?Book    
    {
        $book = $this->findAction->execute($updated['id'] ?? 0);
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