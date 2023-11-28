<?php

namespace App\Data;

class BookData extends BaseData
{
    public function  __construct(
        public ?int $id = null,
        public ?string $title = null,
        public ?int $year = null,
        public ?float $rating = null,
        public ?string $description = null,
        public ?int $category_id = null,
        public ?string $image = null,
        public ?array $authors = null,
        public ?array $reviews = null
    ) {}

    public static function fromArray(array $data): ?self
    {
        return match ($data) {
            null    => null,
            default => new self(
                    id: $data['id'] ?? null,
                    title: $data['title'] ?? null,               
                    year: $data['year'] ?? null,
                    rating: $data['rating'] ?? null,
                    category_id: $data['category_id'] ?? null,
                    image: $data['image'] ?? null,
                    description: $data['description'] ?? null,
                    authors: $data['authors'] ?? [],
                    reviews: $data['reviews'] ?? []
                )
        };
    }
}