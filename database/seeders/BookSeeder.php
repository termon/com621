<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Database\Seeder;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1 = Category::create(['name' => "Fiction"]);
        $c2 = Category::create(['name' => "Technology"]);
        $c3 = Category::create(['name' => "Horror"]);
        $c4 = Category::create(['name' => "Miscellaneous"]);
        
        $b1 = Book::create([
            'title' => 'HTML5',
            'author' => 'J. Smith',
            'slug' => str('HTML5')->slug(),
            'year' => 2022,
            'rating' => 3.0,
            'category_id' => $c2->id,
            'description' => "HTML5 provides the breadth of information you'll need to start creating the next generation of HTML5 websites. It covers all the base knowledge required for standards-compliant, semantic, modern website creation. It also covers the full HTML5 ecosystem and the associated APIs that complement the core HTML5 language. It begins by tackling the basics of HTML5, ensuring that you know best practices and key uses of all of the important elements, including those new to HTML5. This section also covers extended usage of CSS3, JavaScript, and DOM manipulation, making you proficient in all core aspects of modern website creation."
        ]);
       

        $b2 = Book::create([
            'title' => 'CSS3',
            'author' => 'A. Other',
            'slug' => str('CSS3')->slug(),
            'year' => 2022,
            'category_id' => $c2->id,
            'rating' => 3.0,
            'description' => "CSS3, Fourth Edition, is a fully revamped and extended version of one of the most comprehensive and bestselling books on the latest HTML5 and CSS techniques for responsive web design. It emphasizes pragmatic application, teaching you the approaches needed to build most real-life websites, with downloadable examples in every chapter. "
        ]);
       

        $b3 = Book::create([
            'title' => 'PHP8',
            'author' => 'J. Smith',
            'slug' => str('PHP8')->slug(),
            'year' => 2023,
            'category_id' => $c2->id,
            'rating' => 4.5,
            'description' => "Learn how to develop elegant and rock-solid systems using PHP, aided by three key elements: object fundamentals, design principles, and best practices. The 6th edition of this popular book has been fully updated for PHP 8, including attributes, constructor property promotion, new argument and return pseudo-types, and more. It also covers many features new since the last edition including typed properties, the null coalescing operator, and void return types. This book provides a solid grounding in PHP's support for objects, it builds on this foundation to instill core principles of software design and then covers the tools and practices needed to develop, test, and deploy robust code."
        ]);
        
        $b4 = Book::create([
            'title' => 'Sample Fiction',
            'author' => 'J. Smith',
            'slug' => str('Sample Fiction')->slug(),
            'year' => 2020,
            'category_id' => $c1->id,
            'rating' => 4.5,
            'description' => "A fiction book."
        ]);

        $b4 = Book::create([
            'title' => 'Sample Horror',
            'author' => 'J. Sod',
            'slug' => str('Sample Horror')->slug(),
            'year' => 2021,
            'category_id' => $c3->id,
            'rating' => 4.5,
            'description' => "A horror book."
        ]);

        Book::factory()->count(100)->create([ 'category_id' => $c4->id]);
        
    }
}
