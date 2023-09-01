<?php

use App\Http\Controllers\AuthorBookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;

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

Route::get("/",[HomeController::class,'index'] )->name("home");

Route::get("/about",[HomeController::class,'about'] )->name("about");

Route::get("/books/create",    [BookController::class, "create"])->name("books.create"); 
Route::post("/books",          [BookController::class, "store"])->name("books.store"); 
Route::get("/books",           [BookController::class, 'index'])->name("books.index");
Route::get("/books/{id}/edit", [BookController::class, "edit"])->name("books.edit");
Route::put("/books/{id}",      [BookController::class, "update"])->name("books.update");
Route::get("/books/{id}",      [BookController::class, "show"])->name("books.show");
Route::delete("/books/{id}",   [BookController::class, "destroy"])->name("books.destroy");
Route::post("/books",          [BookController::class, "store"])->name("books.store"); 

Route::get("/reviews/create/{id}", [ReviewController::class, "create"])->name("reviews.create"); 
Route::post("/reviews",            [ReviewController::class, "store"])->name("reviews.store"); 

Route::get("/reviews/{review}",    [ReviewController::class, "show"])->name("reviews.show"); 
Route::delete("/reviews/{review}", [ReviewController::class, "destroy"])->name("reviews.destroy");

//Route::get("books/{id}/addauthor",  [AuthorBookController::class, "create"])->name("authorbook.create");
//Route::post("books/{id}/addauthor", [AuthorBookController::class, "store"])->name("authorbook.store");

//Route::resource('books', BookController::class);


// Route::get('/', function () {
//     $title = "Welcome View";
//     $topics = ["PHP", "HTML", "CSS"];
//     return view('welcome', [
//         'title' => $title,
//         'topics' => $topics
//     ]);
// });

// Route::get("/about", function() {
//     return view('about');
// });

// Route::get("/books", function() {
//     $books = Book::all();
//     return view('book.index', ['books' => $books]);
// });

// note: must come before /books/{id}
// Route::get("/books/create", function() { 
//     return view('book.create', ['book' => new Book]);
// });

// Route::get("/books/{id}", function($id) {
//      $book = Book::findOrFail($id);   
//      return view('book.show', ['book' => $book]);
// })->name('books.show');

// Route::get("/books/{id}/edit", function($id) {
//     $book = Book::findOrFail($id);   
//     return view('book.edit', ['book' => $book]);
// });

// Route::post("/books", function(Request $request, Book $b) {
//     $book = $request->validate([
//         'title' => ['required','unique:books'],
//         'author' => 'required',
//         'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
//         'rating' => ['required', 'numeric', 'min:0', 'max:5'],
//         'description' => ['min:0', 'max:500'],
//     ]);
   
//     Book::create($book);
//     return redirect("/books");  
// });

// Route::put("/books/{id}", function(Request $request, int $id) {
//     $book = Book::findOrFail($id);

//     $updates = $request->validate([
//         'title' => ['required',Rule::unique('books')->ignore($id)], // or ignore($book)
//         'author' => 'required',
//         'year' => ['required', 'numeric', 'min:2000', 'max:2024'],
//         'rating' => ['required', 'numeric', 'min:0', 'max:5'],
//         'description' => ['min:0', 'max:500'],
//     ]);

//     $book->update($updates);   
//     return redirect("/books");  
// });

// Route::delete("/books/{id}", function(int $id) {
//     $book = Book::findOrFail($id);
//     $book->delete();
//     return redirect("/books");
// });
