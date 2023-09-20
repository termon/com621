<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Author;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Livewire\Forms\BookForm;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\File;

class BookComponent extends Component
{
    use WithFileUploads;

    public ?Book $book;
    public Collection $categories;

    public Collection $authors;
    public Collection $book_author_ids;
    
    public $id;

    //#[Rule('required')] 
    public $title;

    //#[Rule('required')] 
    public $year;

    //#[Rule('required')] 
    public $rating;

    public $category_id;

    //#[Rule('required')] 
    public $description;

    //#[Rule('nullable')]
    public $image;

    // file upload
    public $imagefile = null;
    

    #[Computed()]
    public function availableAuthors() 
    {
        //dd($this->book_author_ids);
        //$a = $this->authors->whereNotIn('id',$this->book_author_ids);
        return $this->authors;
    }

    public function propertiesFromBook(Book $book)
    {
        $this->id = $book->id;
        $this->title = $book->title;
        $this->year = $book->year;
        $this->rating = $book->rating;
        $this->description = $book->description; 
        $this->category_id = $book->category_id;     
        $this->book_author_ids = $book->authors->pluck('id');

        $this->image = $book->image;   
    }
   
    public function propertiesToBook()
    {
        $this->book->title = $this->title;
        $this->book->year = $this->year;
        $this->book->rating = $this->rating;
        $this->book->description = $this->description;
        $this->book->authors()->sync($this->book_author_ids);  
        
        if ($this->imagefile) {             
           $this->book->image = 'data:' . $this->imagefile->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->imagefile->path()));           
        }
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
        // add invalid book id (0) as placeholder with additional validator 'exists:authors,id'
        $this->book_author_ids = $this->book_author_ids->push(0);  
    }

    public function removeAuthor($id)
    {       
        // possibly re-assign book_authors for re-render       
        $this->book_author_ids = $this->book_author_ids->filter(fn($v, $k) => $v != $id ); //id needs to be key (not position)
    }

    public function save() 
    {
        $this->validate([
                'title' => ['required',Rule::unique('books')->ignore($this->id)],                
                'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
                'rating' => ['required', 'numeric', 'min:0', 'max:5'],
                'category_id' => ['required', 'exists:categories,id'],
                'description' => ['min:0', 'max:1000'],
                'image' => ['nullable'],
                'imagefile' => ['nullable',File::types('jpeg,png,jpg')->max(10*1024) ], 
                'book_author_ids.*' => ['required','exists:authors,id'],
            ], 
            ['book_author_ids.*' => 'Please select Author']
        ); 

        $this->propertiesToBook();
        $this->book->save();
       
        return redirect()->route('books.show', ['id'=>$this->book->id])->with('success','Book updated');
    }

    public function render()
    {
        return view('livewire.book-component');
    }
}
