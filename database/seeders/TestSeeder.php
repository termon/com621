<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Database\Seeder;


class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a1 = Author::create(['name' => 'Author 1' ]);             
        $c1 = Category::create(['name' => "Category 1"]);
  
        // book with no authors
        Book::create([
            'title' => 'Book 1',                        
            'year' => 2022,
            'rating' => 0,
            'category_id' => $c1->id,
            'description' => "Book 1 Description",           
        ]);

        //book with 1 author
        $b2 = Book::create([
            'title' => 'Book 2',                        
            'year' => 2022,
            'rating' => 0,
            'category_id' => $c1->id,
            'description' => "Book 2 Description",           
        ]);
        $b2->reviews()->saveMany(Review::factory()->count(5)->make());
        $b2->authors()->saveMany([$a1]);  
    }
}
