<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Database\Seeders\TestSeeder;
use App\Repositories\BookRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    protected static BookRepository $repo;

    public static function setUpBeforeClass(): void {

        parent::setUpBeforeClass();

        self::$repo = app(BookRepository::class);
       
    }


    public function test_get_all_books_when_none_should_return_zero_books(): void
    {       
        //$this->seed(TestSeeder::class);  
        //$b1 = Book::factory()->count(1);
        $books = self::$repo->all();
        $this->assertEquals(0, $books->count()); 
    }

    public function test_get_books_when_one_added_should_return_one_book(): void
    {
        $c1 = Category::create(['name' => 'Category 1']);
        Book::factory()->create(['category_id' => $c1->id]);
        
        $books = self::$repo->all();
        $this->assertEquals(1, $books->count()); 
    }

    public function test_create_book_returns_created_book(): void
    {
        $c1 = Category::create(['name' => 'Category 1']);
        $model = Book::factory()->make(['category_id' => $c1->id]);
        $book = self::$repo->create($model->attributesToArray());
        
        $books = self::$repo->find($book->id);
        $this->assertEquals($book->title, $model->title); 
        $this->assertEquals($book->category_id, $model->category_id); 
        $this->assertEquals($book->rating, $model->rating);
        $this->assertEquals($book->description, $model->description);
        $this->assertEquals($book->image, $model->image);   
    }

    public function test_get_books_when_many_added_should_return_many_books(): void
    {
        $c1 = Category::create(['name' => 'Category 1']);
        $created = Book::factory()->count(10)->create(['category_id' => $c1->id]);
      
        $books = self::$repo->all();
        $this->assertEquals(10, $books->count()); 
    }

    public function test_create_book_without_author_should_return_a_new_book_with_zero_authors(): void
    {   
        // arrange
        $c1 = Category::create(['name' => 'Category 1']);
        $model = Book::factory()->make(['category_id' => $c1->id]);

        // act
        $book = self::$repo->create($model->attributesToArray());
              
        // assert
        $this->assertEquals($book->title, $model->title); 
        $this->assertEquals($book->category_id, $model->category_id); 
        $this->assertEquals($book->rating, $model->rating);
        $this->assertEquals($book->description, $model->description);
        $this->assertEquals($book->image, $model->image);   
        $this->assertEquals(0, $book->authors()->count()); 
    }

    public function test_create_book_with_two_authors_should_return_a_new_book_with_two_authors(): void
    {
        // arrange
        $c1 = Category::create(['name' => 'Category 1']);
        $authors = Author::factory()->count(2)->create();
        
        $model = Book::factory()->make(['category_id' => $c1->id, 'authors' => $authors]);
 
         // act
        $book = self::$repo->create($model->attributesToArray());
               
         // assert
         $this->assertEquals(2, $book->authors()->count()); 
    }
}
