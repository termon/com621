<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\Role;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Services\BookService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    
    // protected static BookService $repo;

    // public static function setUpBeforeClass(): void {

    //     parent::setUpBeforeClass();

    //     self::$repo = app(Bookservice::class);
       
    // }

    public function test_home_page_when_unauthenticated_returns_200_response(): void {
        // act
        $response = $this->get('/');

        // assert
        $response->assertStatus(200);
    }  

    public function test_home_page_when_unauthenticated_login_register_links_visible(): void {
        
        // act
        $response = $this->get('/');

        // assert
        $response->assertSeeText("Login");
        $response->assertSeeText("Register");
    }  

    public function test_book_index_when_unauthenticated_returns_a_302_response(): void
    {
        $response = $this->get('/books');
        $response->assertStatus(302);
    }

    public function test_book_index_when_authenticated_returns_200_response(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/books');
        $response->assertStatus(200);
    }

    public function test_book_index_when_authenticated_books_title_visible(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/books');
        $response->assertSeeText("Books");
    }

    public function test_book_index_when_unauthorised_create_link_not_visible(): void
    {
        $this->actingAs(User::factory()->create(['role' => Role::GUEST]));

        $response = $this->get('/books');
        $response->assertStatus(200);
        $response->assertDontSeeText("Create");
    }

    public function test_book_create_when_unauthorised_returns_403_response(): void {
        // arrange
        $this->actingAs(User::factory()->create(['role' => Role::GUEST]));
        
        // act
        $response = $this->get('/books/create');
        
        // assert
        $response->assertStatus(403);
    }

    public function test_book_create_when_authorised_returns_200_response(): void {
        // arrange
        $this->actingAs(User::factory()->create(['role' => Role::AUTHOR]));
        
        // act
        $response = $this->get('/books/create');
        
        // assert
        $response->assertStatus(200);
        $response->assertSeeText("Create Book");
    }

    public function test_book_create_when_authorised_book_title_visible(): void {
        // arrange
        $this->actingAs(User::factory()->create(['role' => Role::AUTHOR]));
        $category = Category::create(['name' => 'test']);

        $book_data = [
            'title' => 'Dummy',
            'year' => 2022,    
            'rating' => 0,           
            'category_id' => $category->id,
            'description' => 'description'
        ];
    
        // act
        $create_response = $this->json('POST', '/books', $book_data);
        $create_response->assertStatus(302);    // create redirects to books.index
        $response = $this->get('/books');       // navigate to books.index

        // assert       
        $response->assertSeeText($book_data['title']);

        $this->assertDatabaseHas('books', [
            'title' => 'Dummy',
            'year' => 2022,    
            'rating' => 0,           
            'category_id' => $category->id,
            'description' => 'description'
        ]);
    }

    public function test_create_book_when_valid_creates_book():void {

        $category = Category::create(['name' => 'test1']);
      
        $response = $this->actingAs(User::factory()->create())
            ->json('POST', '/books', [
                'title' => 'Dummy',
                'year' => 2042,
                'rating' => 0,               
                'category_id' => $category->id,
                'description' => 'description'
            ]);
    
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['year']);
       
    }

     

     
}
