<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Repositories\BookRepository;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function __construct(private BookRepository $repo) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
       
        $books = $this->repo->paginate(20, $search);
        //$books = Book::search($search)->paginate(20); //all();
        return view('book.index', ['books' => $books, "search" => $search ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
      
        return view('book.create', ['book' => new Book, 'categories' => $categories ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // $book = $request->validate([
        //     'title' => ['required','unique:books'],
        //     'author' => 'required',
        //     'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
        //     'rating' => ['required', 'numeric', 'min:0', 'max:5'],
        //     'description' => ['min:0', 'max:1000'],
        // ]);
    
        // Book::create($book);
        $book = $this->repo->create($request->validated());

        return redirect()->route("books.index")->with('success', "Book Created Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = $this->repo->find($id); // Book::find($id);
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
        // create map of Category names keyed by Category id  
        $categories = Category::all()->pluck('name', 'id');
          
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return view('book.edit',['book' => $book, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, int $id)
    {
        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        // $validated = $request->validate([
        //     'id' => ['required'], // service method needs id to find model instance
        //     'title' => ['required',Rule::unique('books')->ignore($id)], // or $request->input('id') $request->id
        //     'author' => 'required',
        //     'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
        //     'rating' => ['required', 'numeric', 'min:0', 'max:5'],
        //     'category_id' => ['required', 'exists:categories,id'],
        //     'description' => ['min:0', 'max:1000'],
        // ]);
        // $book->update($validated);
        
        $this->repo->update($request->validated());

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
