<?php

namespace App\Livewire;

use App\Models\Book;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\File;

class BookComponent extends Component
{
    use WithFileUploads;

    public Collection $categories;
    public Collection $authors;
    public Collection $book_author_ids;
    
    public $id;
    public $title;
    public $year;
    public $rating;
    public $category_id;
    public $description;
    public $image;

    // file upload
    public $imagefile = null;
       
    public function mount(?Book $book, Collection $categories, Collection $authors)
    {
        $this->categories = $categories;
        $this->authors = $authors;

        $this->id = $book->id;
        $this->title = $book->title;
        $this->year = $book->year;
        $this->rating = $book->rating;
        $this->description = $book->description; 
        $this->category_id = $book->category_id;     
        $this->book_author_ids = $book->authors->pluck('id');
        $this->image = $book->image;   
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

        if ($this->imagefile) {             
            $this->image = 'data:' . $this->imagefile->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->imagefile->path()));           
        }

        // id will be 0 for new books
        if ($this->id == 0) {
            $book = Book::create($this->only(['title','rating','year','description','category_id', 'image']));
            $book->authors()->sync($this->book_author_ids);          
        } else {
            $book = Book::find($this->id);    
            $book->update($this->only(['title','rating','year','description','category_id', 'image']));
            $book->authors()->sync($this->book_author_ids);    
        }
       
        return redirect()->route('books.show', ['id'=>$book->id])->with('success','Book updated');
    }

    public function render()
    {
        return view('livewire.book-component');
    }
}
