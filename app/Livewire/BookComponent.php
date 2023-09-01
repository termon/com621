<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Author;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Livewire\Forms\BookForm;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;

class BookComponent extends Component
{
    public ?Book $book;
    public Collection $categories;

    public Collection $authors;
    public Collection $book_author_ids;
    
    public $id;

    #[Rule('required')] 
    public $title = '';
    #[Rule('required')] 
    public $year = 0;
    #[Rule('required')] 
    public $rating = 0;
    public $category_id = 0;
    #[Rule('required')] 
    public $description = '';

   
    #[Computed()]
    public function availableAuthors() 
    {
        //$a = $this->authors->whereNotIn('id',$this->book_author_ids);
        return $this->authors;
    }

    public function propertiesFromBook(Book $book)
    {
        $this->title = $book->title;
        $this->year = $book->year;
        $this->rating = $book->rating;
        $this->description = $book->description;    
        $this->book_author_ids = $book->authors->pluck('id');   
    }
   
    public function propertiesToBook()
    {
        $this->book->title = $this->title;
        $this->book->year = $this->year;
        $this->book->rating = $this->rating;
        $this->book->description = $this->description;
        $this->book->authors()->sync($this->book_author_ids);        
    }
    
    public function mount(Book $book, Collection $categories, Collection $authors)
    {
        $this->book = $book;
        $this->categories = $categories;
        $this->authors = $authors;

        $this->propertiesFromBook($book);
    }

    public function addAuthor() 
    {
        //dd($this->authors->whereNotIn('id',$this->book_author_ids));
        $this->book_author_ids->push('');      
    }

    public function removeAuthor($index)
    {
        unset($this->book_author_ids[$index]);
        // possibly re-assign book_authors for re-render
       
    }

    public function save() 
    {
        $this->validate(['book_author_ids.*' => ['required'] ], ['book_author_ids.*' => 'Please select Author']);         
        $this->propertiesToBook();
        $this->book->save();
       
        return redirect()->route('books.show', ['id'=>$this->book->id])->with('success','Book updated');
    }

    public function render()
    {
        return view('livewire.book-component');
    }
}
