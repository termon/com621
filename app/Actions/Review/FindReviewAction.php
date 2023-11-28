<?php

namespace App\Actions\Review;

use App\Models\Review;

class FindReviewAction
{
    public function __construct() { }
    
    public function execute(int $id): ?Review   
    {
        return Review::with(['book','user'])->find($id);
    }
   
}