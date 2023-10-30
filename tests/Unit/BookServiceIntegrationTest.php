<?php

namespace Tests\Unit;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Review;
use App\Models\Category;
use App\Services\BookService;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookServiceIntegrationTest extends TestCase
{
    use RefreshDatabase;
    
    protected static BookService $repo;

    public static function setUpBeforeClass(): void {

        parent::setUpBeforeClass();

        self::$repo = app(Bookservice::class);
       
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
       
        //$book->fresh();
       
        $this->assertEquals($book->title, $model->title); 
        $this->assertEquals($book->category_id, $model->category_id); 
        $this->assertEquals($book->rating, $model->rating);
        $this->assertEquals($book->description, $model->description);
        $this->assertEquals($book->image, $model->image);   
    }

    public function test_find_book_when_exists_returns_book(): void
    {
    // arrange
    $c1 = Category::create(['name' => 'Category 1']);
    $model = Book::factory()->make(['category_id' => $c1->id]);
    $created = self::$repo->create($model->attributesToArray());

    //act
    $book = self::$repo->find($created->id); 
    
    // assert
    $this->assertEquals($book->title, $model->title); 
    $this->assertEquals($book->category_id, $model->category_id); 
    $this->assertEquals($book->rating, $model->rating);
    $this->assertEquals($book->description, $model->description);
    $this->assertEquals($book->image, $model->image); 
    }


    public function test_get_books_when_many_added_should_return_many_books(): void
    {
        $c1 = Category::create(['name' => 'Category 1']);
        Book::factory()->count(10)->create(['category_id' => $c1->id]);
      
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

    public function test_create_book_with_one_5star_review_should_set_book_with_5star_rating(): void
    {
        // arrange
        $category = Category::create(['name' => 'Category 1']);
          
        $book = self::$repo->create(
            Book::factory()->make(['category_id' => $category->id])->attributesToArray()
        );
        
        $review_model = Review::factory()->make(
            ['rating' => 5, 'user_id' => User::factory()->create()->id]
        );
        
        // act
        self::$repo->addReview($book->id, $review_model->toArray());
        $book = self::$repo->find($book->id);
        
         // assert
         $this->assertEquals(5, $book->rating); 
    }

    public function test_create_book_with_one_5star_review_then_remove_review_should_set_book_with_0star_rating(): void
    {
        // arrange
        $category = Category::create(['name' => 'Category 1']);      
        $book = self::$repo->create(
            Book::factory()->make(['category_id' => $category->id])->attributesToArray()
        );
        
        $review_model = Review::factory()->make(
            ['rating' => 5, 'user_id' => User::factory()->create()->id]
        )->toArray();
        
        // act
        $review = self::$repo->addReview($book->id, $review_model);
        $book = self::$repo->deleteReview($review->id);
        
         // assert
         $this->assertEquals(0, $book->rating); 
    }
}
