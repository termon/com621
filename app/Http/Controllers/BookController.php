<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Validation\Rules\File;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    public function __construct(private BookService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input("search");
       
        $books = $this->service->paginate(10, $search);
        //$books = Book::search($search)->paginate(20); //all();
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
    public function store(Request $request)  //BookStoreRequest $request)
    {
        $validated = $request->validate([
            'title' => ['required','unique:books'],
            'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
          
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['min:0', 'max:1000'],            
            'imagefile' => ['nullable', File::types(['png', 'jpg'])->max(1024),],           
        ]);
        $file = $request->files->get('imagefile');        
        if ($file) {             
           $image = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file)); 
           $validated['image'] = $image;
        }
        unset($validated['imagefile']); // remove inputfile
        dd($validated);   
        $book = Book::create($validated);

        // StoreBookRequest passedValidation filter sets the image property from file content
        
        //$book = $this->service->create( $request->safe()->except('imagefile') );

        return redirect()->route("books.show", ['id' => $book->id])->with('success', "Book Created Successfully");  
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = $this->service->find($id); // Book::find($id);
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
    public function update(BookUpdateRequest $request, int $id)
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
        $file = $request->files->get('imagefile'); 
      
        $image = null;       
        if ($file) {             
            $image = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file));           
            $request->merge(['image' => $image ]);
        }   
        dd($request->safe());
        $this->service->update($request->safe()->merge(['image' => $image ])->except('imagefile'));

        return redirect()->route("books.show", ["id" => $id])->with('success', "Book Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $book = $this->service->find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }

        $book->delete();
        return redirect()->route("books.index")->with('success', "Book Destroyed Successfully");
    }

}
