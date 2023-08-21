<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
       
        $books = Book::search($search)->paginate(20); //all();
        return view('book.index', ['books' => $books, "search" => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.create', ['book' => new Book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book = $request->validate([
            'title' => ['required','unique:books'],
            'author' => 'required',
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'description' => ['min:0', 'max:1000'],
        ]);
    
        Book::create($book);
        return redirect()->route("books.index")->with('info', "Book Created Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return view ('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return view('book.edit',['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
            
        $updates = $request->validate([
            'title' => ['required',Rule::unique('books')->ignore($id)], // or ignore($book)
            'author' => 'required',
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'description' => ['min:0', 'max:1000'],
        ]);
        
        $book->update($updates);
        return redirect()->route("books.show", ["id" => $id])->with('success', "Book Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        $book->delete();
        return redirect()->route("books.index")->with('success', "Book Destroyed Successfully");
    }
}
