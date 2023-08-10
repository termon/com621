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
        $a1 = Author::create(['name' =>"J. Smith"]);
        $a2 = Author::create(['name' =>"A. Other"]);
        $a3 = Author::create(['name' =>"F. Bloggs"]);
        $a4 = Author::create(['name' =>"H. Simpson"]);

        $b1 = Book::create([
            'title' => 'HTML5',
            'slug' => str('HTML5')->slug(),
            'year' => 2022,
            'rating' => 3.0,
            'description' => "HTML5 provides the breadth of information you'll need to start creating the next generation of HTML5 websites. It covers all the base knowledge required for standards-compliant, semantic, modern website creation. It also covers the full HTML5 ecosystem and the associated APIs that complement the core HTML5 language. It begins by tackling the basics of HTML5, ensuring that you know best practices and key uses of all of the important elements, including those new to HTML5. This section also covers extended usage of CSS3, JavaScript, and DOM manipulation, making you proficient in all core aspects of modern website creation."
        ]);
        $b1->reviews()->saveMany(Review::factory()->count(5)->make());
        $b1->authors()->saveMany([$a1]);

        $b2 = Book::create([
            'title' => 'CSS3',
            'slug' => str('CSS3')->slug(),
            'year' => 2022,
            'rating' => 3.0,
            'description' => "CSS3, Fourth Edition, is a fully revamped and extended version of one of the most comprehensive and bestselling books on the latest HTML5 and CSS techniques for responsive web design. It emphasizes pragmatic application, teaching you the approaches needed to build most real-life websites, with downloadable examples in every chapter. "
        ]);
        $b2->reviews()->saveMany(Review::factory()->count(8)->make());
        $b2->authors()->saveMany([$a2]);

        $b3 = Book::create([
            'title' => 'PHP8',
            'slug' => str('PHP8')->slug(),
            'year' => 2023,
            'rating' => 4.5,
            'description' => "Learn how to develop elegant and rock-solid systems using PHP, aided by three key elements: object fundamentals, design principles, and best practices. The 6th edition of this popular book has been fully updated for PHP 8, including attributes, constructor property promotion, new argument and return pseudo-types, and more. It also covers many features new since the last edition including typed properties, the null coalescing operator, and void return types. This book provides a solid grounding in PHP's support for objects, it builds on this foundation to instill core principles of software design and then covers the tools and practices needed to develop, test, and deploy robust code."
        ]);
        $b3->reviews()->saveMany(Review::factory()->count(3)->make());
        $b3->authors()->saveMany([$a1, $a4]);

        $b4 = Book::create(Book::factory()->make()->toArray());
        $b4->authors()->save($a1);
    }
}
