<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $title = "Welcome View";
    $topics = ["PHP", "HTML", "CSS"];
    return view('welcome', [
        'title' => $title,
        'topics' => $topics
    ]);
});

Route::get("/about", function() {
    return view('about');
});

Route::get("/books", function() {
    $books = Book::with(['authors', 'reviews'])->get();
    return view('book.index', ['books' => $books]);
});

// note: must come before /books/{id}
Route::get("/books/create", function() { 
    return view('book.create', ['book' => new Book]);
});

Route::get("/books/{id}", function(int $id) {
     $book = Book::with(['reviews','author'])->find($id);   
     return view('book.show', ['book' => $book]);
});

Route::get("/authors/{id}", function(int $id) {
    $author = Author::find($id);
    return view('author.show', ['author' => $author]);
});

Route::post("/books", function(Request $request) {
   
    $book = $request->validate([
        'title' => 'required'
    ]);
    dd($book);
   
    
});

// Route model binding
// Route::get("/book/{book:slug}", function(Book $book) {
//    return view('book.show', ['book' => $book]);
// });
