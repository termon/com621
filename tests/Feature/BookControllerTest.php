<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{

    /**
     * A basic test example.
     */
    public function test_book_index_returns_a_successful_response(): void
    {
        $response = $this->get('/books');

        $response->assertStatus(200);
    }
}
