<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Database\Seeder;


class BookSeederFinal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1 = Category::create(['name' => 'Technical']);
        $c2 = Category::create(['name' => 'Fiction']);
        $c3 = Category::create(['name' => 'Horror']);
        $c4 = Category::create(['name' => 'Anon']);


        Book::create([
            'title' => 'Practical Laravel: Develop clean MVC web',
            'author' => 'Daniel Correa, Paola Vallejo',
            'year' => 2022,
            'rating' => 0,
            'description' => "Laravel is a PHP web application framework with expressive and elegant syntax. We will use Laravel to develop an Online Store application that uses several Laravel features. The Online Store application will be the means to understand straightforward and complex Laravel concepts and how Laravel features can be used to implement real-world applications. This book is written with brief explanations direct to the point. It includes tips, short discussions, and useful phrases found in other books that we have read to provide you with a practical approach that will improve your coding skills.",
            'category_id' => $c1->id,
        ])->reviews()->createMany(Review::factory()->count(5)->make()->toArray());

        Book::create([
            'title' => 'C++ Programming Language',
            'author' => 'Bjarne Stroustroup',
            'year' => 2013,
            'rating' => 0,
            'description' => "The new C++11 standard allows programmers to express ideas more clearly, simply, and directly, and to write faster, more efficient code. Bjarne Stroustrup, the designer and original implementer of C++, has reorganized, extended, and completely rewritten his definitive reference and tutorial for programmers who want to use C++ most effectively. The C++ Programming Language, Fourth Edition, delivers meticulous, richly explained, and integrated coverage of the entire language―its facilities, abstraction mechanisms, standard libraries, and key design techniques. Throughout, Stroustrup presents concise, “pure C++11” examples, which have been carefully crafted to clarify both usage and program design. To promote deeper understanding, the author provides extensive cross-references, both within the book and to the ISO standard.",
            'category_id' => $c1->id,
        ])->reviews()->createMany(Review::factory()->count(1)->make()->toArray());;

        Book::create([
            'title' => 'C# 10 in A Nutshell',
            'author' => 'Joseph Albahari',
            'year' => 2022,
            'rating' => 4.5,
            'description' => "When you have questions about C# 10 or .NET 6, this best-selling guide has the answers you need. C# is a language of unusual flexibility and breadth, and with its continual growth, there's always so much more to learn. In the tradition of O'Reilly's Nutshell guides, this thoroughly updated edition is simply the best one-volume reference to the C# language available today. Organized around concepts and use cases, this comprehensive and complete reference provides intermediate and advanced programmers with a concise map of C# and .NET that also plumbs significant depths. Get up to speed on C#, from syntax and variables to advanced topics such as pointers, closures, and patterns Dig deep into LINQ, with three chapters dedicated to the topic Explore concurrency and asynchrony, advanced threading, and parallel programming Work with .NET features, including regular expressions, networking, assemblies, spans, reflection, and cryptography.",
            'category_id' => $c1->id,
        ])->reviews()->createMany(Review::factory()->count(2)->make()->toArray());

        Book::create([
            'title' => 'Responsive Web Design with HTML5 and CSS',
            'author' => 'Ben Frain',
            'year' => 2022,
            'rating' => 4.0,
            'description' => "Responsive Web Design with HTML5 and CSS, Fourth Edition, is a fully revamped and extended version of one of the most comprehensive and bestselling books on the latest HTML5 and CSS techniques for responsive web design. It emphasizes pragmatic application, teaching you the approaches needed to build most real-life websites, with downloadable examples in every chapter. Written in the author's friendly and easy-to-follow style, this edition covers all the newest developments and improvements in responsive web design, including approaches for better accessibility, variable fonts and font loading, and the latest color manipulation tools making their way to browsers. You can enjoy coverage of bleeding-edge features such as CSS layers, container queries, nesting, and subgrid. The book concludes by exploring some exclusive tips and approaches for front-end development from the author. By the end of the book, you will not only have a comprehensive understanding of responsive web design and what is possible with the latest HTML5 and CSS, but also the knowledge of how to best implement each technique. Read through as a complete guide or dip in as a reference for each topic-focused chapter.",
            'category_id' => $c1->id,
        ]);

        Book::factory()->count(3)->create( ['category_id' => $c4->id]);

    }
}
