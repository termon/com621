<?php
namespace App\Services;

use Illuminate\Support\Collection;

use Exception;

class BookArrayService {

    public function __construct(private string $filepath) {
        $this->createFileIfNotExists();
    }

    private function createFileIfNotExists(): void
    {
        if (!file_exists($this->filepath)) {
            file_put_contents($this->filepath, json_encode([]));
        }
    }

    public function all(): Collection
    {
        $json = file_get_contents($this->filepath);

        // json data array
        $records = json_decode($json, true);

        // map records to BookData collection
        return collect(array_map(fn($r) => BookModel::fromArray($r), $records));
    }

    public function find(int $id): ?BookModel
    {
        return $this->all()->firstWhere('id',$id);
    }

    public function findOrFail(int $id): BookModel | \Exception
    {
        $record = $this->find($id);
        if ($record == null) {
            throw new \Exception("Not found");
        }
        return $record;
    }

    public function create(BookModel $record): BookModel
    {
        // load existing data
        $records = $this->all();
        // set new record id property to next array index
        $record->id = $records->count()+1;

        // add record to collection and store to file
        $records->push($record);
        file_put_contents($this->filepath, json_encode($records));

        // return new record
        return $record;
    }


    public function update(int $id, BookModel $updated): ?BookModel
    {
        // check the record with $id exists
        $record = $this->find($id);
        if ($record != null)
        {
            $records = $this->all();
            // verify existing record['id'] matches updated['id']
            if ($record->id == $updated->id) {
                $records[$id] = $updated;
                file_put_contents($this->filepath, json_encode($records));
                return $updated;
            }
        }
        // record not found
        return null;
    }

    public function delete(int $id): bool
    {
        // verify record exists and delete
        if ($this->find($id) != null) {
            $records = $this->all();
            $records->forget($id);
            file_put_contents($this->filepath, json_encode($records));
            return true;
        }
        // record not found
        return false;
    }
    public function reset()
    {
        file_put_contents($this->filepath, json_encode([]));
    }

    public function seed()
    {
        // clear out existing database
        $this->reset();

        // add seed data
        $this->create(BookModel::fromArray(['title' =>"PHP 8 Objects, Pattens and Practice", "author" => "Matt Zandstra", "year" => "2021", "rating" => 4.7, "description" => "Learn how to develop elegant and rock-solid systems using PHP, aided by three key elements: object fundamentals, design principles, and best practices. The 6th edition of this popular book has been fully updated for PHP 8, including attributes, constructor property promotion, new argument and return pseudo-types, and more. It also covers many features new since the last edition including typed properties, the null coalescing operator, and void return types. This book provides a solid grounding in PHP's support for objects, it builds on this foundation to instill core principles of software design and then covers the tools and practices needed to develop, test, and deploy robust code."]));
        $this->create(BookModel::fromArray(['title' =>"Test-Driven Development with PHP 8", "author" => "Rainier Sarabia", "year" => "2023", "rating" => 4.1, "description" => "PHP web developers end up building complex enterprise projects without prior experience in test-driven and behavior-driven development which results in software that’s complex and difficult to maintain. This step-by-step guide helps you manage the complexities of large-scale web applications. It takes you through the processes of working on a project, starting from understanding business requirements and translating them into actual maintainable software, to automated deployments."]));
        $this->create(BookModel::fromArray(['title' =>"Learn PHP 8", "author" => "Steve Prettyman", "year" => "2020", "rating" => 3.9, "description" => "Write solid, secure, object-oriented code in the new PHP 8. In this book you will create a complete three-tier application using a natural process of building and testing modules within each tier. This practical approach teaches you about app development and introduces PHP features when they are actually needed rather than providing you with abstract theory and contrived examples. In Learn PHP 8, programming examples take advantage of the newest PHP features; you’ll follow a learn-by-doing approach, which provides you with complete coding examples. “Do It” exercises in each chapter provide the opportunity to make adjustments to the example code. The end-of-chapter programming exercises allow you to develop your own applications using the algorithms demonstrated in the chapter."]));
        $this->create(BookModel::fromArray(['title' =>"The Art of Modern PHP 8", "author" => "Joseph Edmonds ", "year" => "2020", "rating" => 4.7, "description" => "PHP has come a long way since its introduction. While the language has evolved with PHP 8, there are still a lot of websites running on a version of PHP that is no longer supported. If you are a PHP developer working with legacy PHP systems and want to discover the tenants of modern PHP, this is the book for you. The Art of Modern PHP 8 walks you through the latest PHP features and language concepts. The book helps you upgrade your knowledge of PHP programming and practices. Starting with object-oriented programming (OOP) in PHP and related language features, you'll work through modern programming techniques such as inheritance, understand how it contrasts with composition, and finally look at more advanced language features. You'll learn about the MVC pattern by developing your own MVC system and advance to understanding what a DI container does by building a toy DI container. The book gives you an overview of Composer and how to use it to create reusable PHP packages. You'll also find techniques for deploying these packages to package libraries for other developers to explore."]));
        $this->create(BookModel::fromArray(['title' =>"Responsive Web Design with HTML5 and CSS", "author" => "Ben Frain", "year" => "2022", "rating" => 4.8, "description" => "Responsive Web Design with HTML5 and CSS, Fourth Edition, is a fully revamped and extended version of one of the most comprehensive and bestselling books on the latest HTML5 and CSS techniques for responsive web design. It emphasizes pragmatic application, teaching you the approaches needed to build most real-life websites, with downloadable examples in every chapter. Written in the author's friendly and easy-to-follow style, this edition covers all the newest developments and improvements in responsive web design, including approaches for better accessibility, variable fonts and font loading, and the latest color manipulation tools making their way to browsers. You can enjoy coverage of bleeding-edge features such as CSS layers, container queries, nesting, and subgrid."]));        
        $this->create(BookModel::fromArray(['title' =>"Hypermedia Systems ", "author" => "Carson Gross", "year" => "2023", "rating" => 4.8, "description" => "Learn how hypermedia, the revolutionary idea that created The Web, can be used today to build modern, sophisticated web applications, often at a fraction of the complexity of popular JavaScript frameworks. In this book we will explore a simpler approach to building applications on the Web and beyond with htmx and Hyperview, two technologies that embrace hypermedia as a system architecture. We will look at what a hypermedia system is comprised of and what makes it special when compared with other system architectures. We will then look at how htmx, a modern hypermedia-oriented web front end library, makes it possible to build sophisticated user experiences using hypermedia. Finally, we will look at Hyperview, a modern hypermedia system for building mobile applications."]));

    }
}
