<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\File;

class BookForm extends Form
{   
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

    public function setFormData(?Book $book, Collection $categories, Collection $authors): void {
        if (isset($book)) {
        $this->id = $book->id;
        $this->title = $book->title ;
        $this->year = $book->year;
        $this->rating = $book->rating;
        $this->description = $book->description; 
        $this->category_id = $book->category_id;     
        $this->book_authors = $book->authors->pluck('id')->toArray();
        $this->image = $book->image;
        }

        $this->categories = $categories;
        $this->authors = $authors;
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

    public function updating() {
        if ($this->image_file) {             
            $this->image = 'data:' . $this->image_file->getMimeType() . ';base64,' . base64_encode(file_get_contents($this->image_file->path()));                      
        }
    }
     
    public function rules() {
        return [
            'title' => ['required',Rule::unique('books','title')->ignore($this->id)],                
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],
            'image' => ['nullable'],
            'image_file' => ['nullable',File::types('jpeg,png,jpg')->max(10*1024) ], 
            'book_authors' => ['required','min:1','max:4','array','exists:authors,id'],
        ];
    }

    public function messages() {
        return ['book_authors.*' => 'Please select Author']; 
    }

    public function validationAttributes() 
    {
        return [
            'title' => 'form.title',
        ];
    }
}
