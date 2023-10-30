<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;

class AuthorBookController extends Controller
{

    public function __construct(private BookService $service) {}

    /**
     * Show the form for creating a new resource for book $id.
     */
    public function create($id )
    {       
        $book = $this->service->find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        // make list of authors not currently associated with book 
        $authors = $this->service->getAuthorSelectList($book); 

        return view('authorbook.create', ['book' => $book, 'authors' => $authors]);
    }
    
    /**
     * Store a newly created AuthorBook resource in storage.
     */
    public function store(int $id, Request $request)
    {
        $data = $request->validate([           
            'author_id' => ['required'],
        ],[
            'author_id' => 'Author must be selected'
        ]);

        $book = $this->service->addAuthorToBook($id, $data['author_id']);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$request->book_id} does not exist!");
        }
        return redirect()->route('books.show', ['id' => $book->id])->with('success', "Author Added!");
    }

    /**
     * GET - display delete authorbook form
     */
    public function delete(int $id)
    {
        $book = $this->service->find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        $authors = $book->authors->pluck('name', 'id')->all();
        return view('authorbook.delete', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Remove the specified AuthorBook resource from storage.
     */
    public function destroy(int $id, Request $request)
    {
        $data = $request->validate([           
            'author_id' => ['required'],
        ],[
            'author_id' => 'Author must be selected'
        ]);
       
        $book = $this->service->removeAuthorFromBook($id, $data['author_id']);
        // shouldn't need to check as post form contained valid book id
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return redirect()->route('books.show', ['id' => $id])->with('success', "Author removed!");
    }
}
