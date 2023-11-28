<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\BookService;

class BookSearch extends Component
{
    use WithPagination;

    public string $query = "";

    public function render(BookService $service) {
        $books = Book::search($this->query)
        //$books = $service->searchBooks($this->query)      
                         ->paginate(10)
                         ->withQueryString();
        return view('livewire.book-search',['books' => $books]);
    }
}
