<?php

namespace App\Http\Controllers;

use App\Actions\Book\CreateBookAction;
use App\Actions\Book\DeleteBookAction;
use App\Actions\Book\FindBookAction;
use App\Actions\Book\SearchBooksAction;
use App\Actions\Book\UpdateBookAction;
use App\Data\BookData;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookActionController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, SearchBooksAction $search)
    {
        $this->authorize('viewAny', Book::class);

        $query = $request->input("search");
       
        $books = $search->execute($query)->paginate(10)->withQueryString();
         
        return view('book.index', ['books' => $books, "search" => $query ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Book::class);

        $categories = Category::all()->pluck('name', 'id');
        $authors = Author::all()->pluck('name', 'id');
        return view('book.create', ['book' => new Book, 'categories' => $categories, 'authors' => $authors ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request, CreateBookAction $create)
    {
        $this->authorize('create', Book::class);

        // using BookData and action
        $book = $create->execute(BookData::fromArray($request->validated()));

        return redirect()->route("books.show", ['id' => $book->id])->with('success', "Book Created Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, FindBookAction $find)
    {
        $this->authorize('view', Book::class);

        $book = $find->execute($id); 
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return view ('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id, FindBookAction $find)
    {
        $this->authorize('update', Book::class);

        $book = $find->execute($id);     
        // create map of Category names keyed by Category id  
        $categories = Category::all()->pluck('name', 'id');
        $authors = Author::all()->pluck('name', 'id');
          
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return view('book.edit',['book' => $book, 'categories' => $categories, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, BookUpdateRequest $request, FindBookAction $find, UpdateBookAction $update)
    {
        $this->authorize('update', Book::class);

        $book = $find->execute($id);    
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        // using BookData and action
        $book = $update->execute($id, BookData::fromArray($request->validated()));

        return redirect()->route("books.show", ["id" => $id])->with('success', "Book Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, DeleteBookAction $delete)
    {
        $this->authorize('delete', Book::class);

        if (!$delete->execute($id)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        return redirect()->route("books.index")->with('success', "Book Destroyed Successfully");
    }

}
