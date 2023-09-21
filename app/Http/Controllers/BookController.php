<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Repositories\BookRepository;
use Illuminate\Validation\Rules\File;
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
       
        $books = $this->repo->paginate(10, $search);
        //$books = Book::search($search)->paginate(20); //all();
        return view('book.index', ['books' => $books, "search" => $search ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        $authors = Author::all()->pluck('name', 'id');
        return view('book.create', ['book' => new Book, 'categories' => $categories, 'authors' => $authors ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // $book = $request->validate([
        //     'title' => ['required','unique:books'],
        //     'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
        //     'rating' => ['required', 'numeric', 'min:0', 'max:5'],
        //     'category_id' => ['required', 'exists:categories,id'],
        //     'description' => ['min:0', 'max:1000'],
        //     'imagefile' => [File::types(['png', 'jpg', 'jpeg'])->max(12 * 1024)],
        //     'image' => ['nullable']
        // ]);
        $book = $this->repo->create( $request->safe()->except('imagefile') );

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
        $authors = Author::all()->pluck('name', 'id');
          
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        return view('book.edit',['book' => $book, 'categories' => $categories, 'authors' => $authors]);
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

    public function author_add(int $id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::pluck('name', 'id')->all();
        return view('book.author_add', ['book' => $book, 'authors' => $authors]);
    }

    public function author_store(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        $book_author_ids = $book->authors->pluck('id');

        $book_author_ids->push($request->author_id);
        $book->authors()->sync($book_author_ids);
        $book->save();
        return redirect()->route('books.show', ['id' => $book->id]);
    }

}
