<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use App\Repositories\BookRepository;
use Illuminate\Validation\Rules\File;

class BookComponent extends Component
{
    use WithFileUploads;

    public Collection $categories;
    public Collection $authors;
    
    public $id;
    public $title;
    public $year;
    public $rating;
    public $category_id;
    public $description;
    public $image;
    public array $book_authors;

    // file upload
    public $image_file = null;
       
    // #[Computed]
    // public function image()
    // {
    //     if ($this->image_file) {             
    //         $this->image = 'data:' . $this->image_file->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->image_file->path()));           
    //     }     
    // }

    public function updating() {
        if ($this->image_file) {             
            $this->image = 'data:' . $this->image_file->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->image_file->path()));           
            dd($this->all());
        }
    }

    public function mount(?Book $book, Collection $categories, Collection $authors) {
        $this->categories = $categories;
        $this->authors = $authors;

        $this->id = $book->id;
        $this->title = $book->title;
        $this->year = $book->year;
        $this->rating = $book->rating;
        $this->description = $book->description; 
        $this->category_id = $book->category_id;     
        $this->book_authors = $book->authors->pluck('id')->toArray();
        $this->image = $book->image;   
    }

    public function addAuthor()  {       
        // add invalid book id (0) as placeholder with additional validator 'exists:authors,id'
        //$this->book_authors = $this->book_authors->push(0);
        $this->book_authors[] = 0;
    }

    public function removeAuthor($id) {       
        // possibly re-assign book_authors for re-render       
        //$this->book_authors = $this->book_authors->filter(fn($v, $k) => $v != $id ); //id needs to be key (not position)
        $key = array_search($id, $this->book_authors);
        unset($this->book_authors[ $key ]);
    }

    public function save(BookRepository $repo) {
        $this->validate([
                'title' => ['required',Rule::unique('books')->ignore($this->id)],                
                'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
                //'rating' => ['required', 'numeric', 'min:0', 'max:5'],
                'category_id' => ['required', 'exists:categories,id'],
                'description' => ['min:0', 'max:1000'],
                'image' => ['nullable'],
                'image_file' => ['nullable',File::types('jpeg,png,jpg')->max(10*1024) ], 
                'book_authors' => ['required','min:1','max:4','array','exists:authors,id'],
            ], 
            ['book_authors.*' => 'Please select Author']
        ); 

        // if ($this->image_file) {             
        //     $this->image = 'data:' . $this->image_file->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->image_file->path()));           
        // }
       
        // id will be 0 for new books
        if ($this->id == 0) {
            $book = $repo->create($this->only(['title','rating','year','description','category_id', 'image']));
            //$book = Book::create($this->only(['title','rating','year','description','category_id', 'image']));
            //$book->authors()->sync($this->book_authors);          
        } else {
            $book = $repo->update(['authors' => $this->book_authors, ...$this->only(['id', 'title','rating','year','description','category_id', 'image',])]);
            //$book = Book::find($this->id);    
            //$book->update($this->only(['title','rating','year','description','category_id', 'image']));
            //$book->authors()->sync($this->book_authors);    
        }
        if ($book === null) {
            return redirect()->route('books.index')->with('error','Book not updated');    
        }
       
        return redirect()->route('books.show', ['id'=>$book->id])->with('success','Book updated');
    }

    public function render()
    {
        return view('livewire.book-component');
    }
}
