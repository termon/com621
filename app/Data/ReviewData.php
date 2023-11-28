<?php

namespace App\Data;

use Carbon\Carbon;

class ReviewData extends BaseData
{
    public function  __construct(
        public ?int $id = null,
        public ?int $book_id = null,
        public ?int $user_id = null,    
        public ?Carbon $reviewed_on = null,           
        public ?float $rating = null,
        public ?string $comment = null,
    ) {}

    public static function fromArray(array $data): ?self
    {
        return match ($data) {
            null    => null,
            default => new self(
                    id: $data['id'] ?? null,
                    book_id: $data['book_id'] ?? null,               
                    user_id: $data['user_id'] ?? null,
                    reviewed_on: $data['reviewed_on'] ?? null,
                    rating: $data['rating'] ?? null,
                    comment: $data['comment'] ?? null
                )
        };
    }

}