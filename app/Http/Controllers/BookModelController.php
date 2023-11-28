<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

// Simple Eloquent Model Actions with local validation
class BookModelController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Book::class);

        $query = $request->input("search");
    
        $books = Book::search($query)->paginate(10)->withQueryString();
        
        return view('book.index', ['books' => $books, "search" => $query ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // authorisation can happen here or via route can('create', Book::class)
        $this->authorize('create', Book::class);

        $categories = Category::all()->pluck('name', 'id');
        $authors = Author::all()->pluck('name', 'id');
        return view('book.create', ['book' => new Book, 'categories' => $categories, 'authors' => $authors ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Book::class);

        // validate data from request object
        $validated = $request->validate([
            'title' => ['required','unique:books'],
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],            
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],      
            'image' => ['nullable', File::types(['png', 'jpg'])->max(1024),],           
        ]); 

        //update validated image with base64 string
        if ($request->hasFile('image')) {  
            $file = $request->image;                
            $image = 'data:' . $file->getMimeType() 
                             . ';base64,'  
                             . base64_encode(file_get_contents($file));            
            $validated['image'] = $image;
        }
       
        // store in public disk
        // if ($request->hasFile('image')) {  
        //     // store file to books folder in public disk
        //     $path = $request->image->store('books', 'public');     
        //     $validated['image'] = $path ;   // add image path to validated data
        // }

        // using spatie media library
        // if ($request->hasFile('image')) { 
        //     $book->addMediaFromRequest('image')->toMediaCollection("public");
        // }

        $book = Book::create($validated); 
 
        return redirect()->route("books.show", ['id' => $book->id])->with('success', "Book Created Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $this->authorize('view', Book::class);

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
        $this->authorize('update', Book::class);

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
    public function update(int $id, Request $request)
    {
        $this->authorize('update', Book::class);

        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        $validated = $request->validate([
            'title' => ['required',Rule::unique('books')->ignore($id)], // or $this->input('id')
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],           
            'image' => ['nullable', File::types(['png', 'jpg'])->max(12 * 1024),],
            'authors.*' => ['nullable']
        ]);

        // base64 image
        if ($request->hasFile('image')) {  
            $file = $request->image;                
            $image = 'data:' . $file->getMimeType() 
                             . ';base64,'  
                             . base64_encode(file_get_contents($file));            
            $validated['image'] = $image;
        }

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

        $book->update(
            collect($validated)->except(['authors'])->toArray()
        );

        return redirect()->route("books.show", ["id" => $id])->with('success', "Book Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', Book::class);

        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        $book->delete();
        return redirect()->route("books.index")->with('success', "Book Destroyed Successfully");
    }

}
