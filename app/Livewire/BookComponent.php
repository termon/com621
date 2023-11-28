<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use App\Services\BookService;
use Livewire\WithFileUploads;

use Illuminate\Validation\Rule;
use App\Livewire\Forms\BookForm;
use Livewire\Attributes\Computed;
use Illuminate\Support\Collection;
use App\Repositories\BookRepository;
use Illuminate\Validation\Rules\File;

class BookComponent extends Component
{
    use WithFileUploads;
    
    public BookForm $form;

    public function mount(?Book $book, Collection $categories, Collection $authors) {
        $this->form->setFormData($book, $categories, $authors);        
    }

    public function updating() {
        $this->form->updating();
    }

    public function addAuthor() {
        $this->form->addAuthor();
    }

    public function removeAuthor($author_id) {
        $this->form->removeAuthor($author_id);
    }

    public function save(BookService $service) {
        $this->form->validate();
 
        // id will be 0 for new books
        if ($this->form->id == 0) {
            $book = $service->createBook($this->form->only(['title','rating','year','description','category_id', 'image']));
        } else {
            dd($this->form);
            $book = $service->updateBook($this->form->id, ['authors' => $this->form->book_authors, ...$this->form->only(['id', 'title','rating','year','description','category_id', 'image',])]);
        }       

        if ($book === null) {
            return redirect()->route('books.index')->with('error','Book saving book');    
        }
       
        return redirect()->route('books.show', ['id'=>$book->id])->with('success','Book updated');
    }

    public function render()
    {
        return view('livewire.book-component');
    }
}
