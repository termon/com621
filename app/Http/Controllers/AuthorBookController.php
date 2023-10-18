<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepository;

class AuthorBookController extends Controller
{

    public function __construct(private BookRepository $repo) {}

    /**
     * Show the form for creating a new resource for book $id.
     */
    public function create($id )
    {
        //$book = Book::findOrFail($request->book_id);
        $book = $this->repo->find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        // make list of authors not currently associated with book 
        $authors = $this->repo->makeAuthorSelectList($book); //Author::all()->diff($book->authors)->pluck('name','id');

        return view('authorbooks.create', ['book' => $book, 'authors' => $authors]);
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

        $book = $this->repo->authorAdd($id, $data['author_id']);
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
        //$book = Book::findOrFail($request->book_id);
        $book = $this->repo->find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        $authors = $book->authors->pluck('name', 'id')->all();
        return view('authorbooks.delete', ['book' => $book, 'authors' => $authors]);
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
       
        $book = $this->repo->authorDelete($id, $data['author_id']);
       
        // shouldn't need to check as post form contained valid book id
        // if (!isset($book)) {
        //     return redirect()->route('book.index')->with('warning', "Book {$id} does not exist!");
        // }
    
        return redirect()->route('books.show', ['id' => $id])->with('success', "Author removed!");
    }
}
