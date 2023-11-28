<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

// Utilising Service and Form Request Classes
class BookServiceController extends Controller
{
    public function __construct(private BookService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Book::class);

        $search = $request->input("search");
       
        $books = $this->service->searchBooks($search)->paginate(10)->withQueryString();
        
        return view('book.index', ['books' => $books, "search" => $search ]);
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
    public function store(BookStoreRequest $request)
    {
        $this->authorize('create', Book::class);

        // using request -
        // $validated = $request->validate([
        //     'title' => ['required','unique:books'],
        //     'year' => ['required', 'numeric', 'min:2000', 'max:2024'],            
        //     'category_id' => ['required', 'exists:categories,id'],
        //     'description' => ['min:0', 'max:1000'],      
        //     'image' => ['nullable', File::types(['png', 'jpg'])->max(1024),],           
        // ]); 

        // using bookservice
        $book = $this->service->createBook($request->validated());
    
        // using form request
        //$validated = $request->validated();

        //update validated image with base64 string
        // if ($request->hasFile('image')) {  
        //     $file = $request->image;                
        //     $image = 'data:' . $file->getMimeType() 
        //                      . ';base64,'  
        //                      . base64_encode(file_get_contents($file));            
        //     $validated['image'] = $image;
        // }
       
        // store in public disk
        // if ($request->hasFile('image')) {  
        //     // store file to books folder in public disk
        //     $path = $request->image->store('books', 'public');     
        //     $validated['image'] = $path ;   // add image path to validated data
        // }

        // create the book with selected validated data
        //$book = $this->service->create( $validated );
       
        // using spatie media library
        // if ($request->hasFile('image')) { 
        //     $book->addMediaFromRequest('image')->toMediaCollection("public");
        // }
 
        return redirect()->route("books.show", ['id' => $book->id])->with('success', "Book Created Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $this->authorize('view', Book::class);

        $book = Book::findOrFail($id);
        $book = $this->service->findBook($id); // Book::find($id);
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
        $this->authorize('update', Book::class);

        $book = $this->service->findBook($id);     
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
    public function update(int $id, BookUpdateRequest $request)
    {
        $this->authorize('update', Book::class);

        $book = $this->service->findBook($id);     
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

         // using BookData and action
        $book = $this->service->updateBook($id, $request->validated());

        // using form request
        //$validated = $request->validated();

        // base64 image
        // if ($request->hasFile('image')) {  
        //     $file = $request->image;                
        //     $image = 'data:' . $file->getMimeType() 
        //                      . ';base64,'  
        //                      . base64_encode(file_get_contents($file));            
        //     $validated['image'] = $image;
        // }

        // stored image
        // if ($request->hasFile('image')) {             
        //     Storage::disk('public')->delete($book->image);   // delete old image file
        //     $path = $request->image->store('books', 'public'); // store public disk books folder
        //     $validated['image'] = $path ;   // add image path to validated data
        // }

        // using spatie media library
        // if ($request->hasFile('image')) { 
        //     $book->addMediaFromRequest('image')->toMediaCollection("public");
        // }

        //$this->service->update($validated); ////($request->safe()->merge(['image' => $image ]));

        return redirect()->route("books.show", ["id" => $id])->with('success', "Book Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, Book $book)
    {
        $this->authorize('delete', $book);
        
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        $book->delete();
        return redirect()->route("books.index")->with('success', "Book Destroyed Successfully");
    }

}
