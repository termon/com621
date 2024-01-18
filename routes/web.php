<?php

use App\Models\Review;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\BookServiceController;
use App\Http\Controllers\ReviewServiceController;

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

Route::get('/hello/{name}/{age?}', function(string $name, ?int $age=null) {
    return "Hello " .  $name . " aged " . ($age ?? 'unknown');
})->where('age', '[0-9]+');;


Route::get('/practical/{question}', function(int $question=1) {
    $items = ['mon', 'tue', 'wed'];    
    return view('home.practical', [ 'question' => $question, 'items' => $items]);
});

Route::get('/test', function() {
    $poor = Review::with('book')->where("rating", 0)->get();
    $result = "";
    foreach($poor as $p) {
        $result .= " {$p->book->title} ";
    } 
    return $result;
});

Route::middleware(['auth'])->group(function() {
    Route::get("/books/create",    [BookServiceController::class, "create"])->name("books.create"); 
    Route::post("/books",          [BookServiceController::class, "store"])->name("books.store"); 
    Route::get("/books",           [BookServiceController::class, 'index'])->name("books.index");
    Route::get("/books/{id}/edit", [BookServiceController::class, "edit"])->name("books.edit");
    Route::put("/books/{id}",      [BookServiceController::class, "update"])->name("books.update");
    Route::get("/books/{id}",      [BookServiceController::class, "show"])->name("books.show");
    Route::delete("/books/{id}",   [BookServiceController::class, "destroy"])->name("books.destroy");  
   
    Route::get("/reviews/create/{id}", [ReviewServiceController::class, "create"])->name("reviews.create");
    Route::post("/reviews",            [ReviewServiceController::class, "store"])->name("reviews.store");
    Route::get("/reviews/{id}",        [ReviewServiceController::class, "show"])->name("reviews.show"); 
    Route::delete("/reviews/{id}",     [ReviewServiceController::class, "destroy"])->name("reviews.destroy");
    
    Route::get("/authorbooks/{id}/create",    [AuthorBookController::class, "create"])->name("authorbooks.create");
    Route::post("/authorbooks/{id}",          [AuthorBookController::class, "store"])->name("authorbooks.store");
    Route::get("/authorbooks/{id}/delete",    [AuthorBookController::class, "delete"])->name("authorbooks.delete");
    Route::delete("/authorbooks/{id}/destroy",[AuthorBookController::class, "destroy"])->name("authorbooks.destroy");
});

Route::post("/logout", [UserController::class, "logout"])->middleware('auth')->name("logout");
  
Route::middleware('guest')->group(function () {
    Route::get("/register",[UserController::class, "create"])->name("register");
  
    Route::post("/register",[UserController::class, "store"]);
  
    Route::get("/login",[UserController::class, "login"])->name("login");
  
    Route::post("/login",[UserController::class, "authenticate"]);
});
  

Route::get("/login",   [UserController::class, "login"])->name("login");
Route::post("/login",  [UserController::class, "authenticate"]); //->name("authenticate");
Route::post("/logout", [UserController::class, "logout"])->name("logout");
Route::get("/register",[UserController::class, "create"])->name("register");
Route::post("/register",[UserController::class, "store"]); //->name("users.store");


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
