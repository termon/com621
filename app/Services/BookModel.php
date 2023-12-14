<?php
namespace App\Services;

class BookModel
{
    public function  __construct(
        public ?int $id = null,
        public ?string $title = '',
        public ?string $author = '',
        public ?int $year = 0,
        public ?float $rating = 0.0,
        public ?string $description = ''
    ) {}

    public static function fromArray(array $data): ?self
    {
        if ($data != null) {
            return new self(
                id: $data['id'] ?? null,
                title: $data['title'] ?? null,
                author: $data['author'] ?? null,
                year: $data['year'] ?? null,
                rating: $data['rating'] ?? null,
                description: $data['description'] ?? null,
            );
        } else {
            return null;
        }
    }

    public function toArray(): array
    {
        return (array) $this;
    }

}