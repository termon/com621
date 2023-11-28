<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Show the form for creating a new review for specified book.
     * DI will auto-create a new Review model for population
     */
    public function create($id, Review $review) { 

        // when you want to control authorisation failure response
        // if (auth()->user()->cannot('create', Review::class)) {
        // if ($request->user()->cannot('create', Review::class)) {
        //    return redirect()->back()->with('warning', 'Not authorised'); 
        //}
        
        // authorise action - display 404 when unauthorised
        $this->authorize('create', Review::class);
       
        $book = Book::find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        
        $review->book_id = $id;
        $review->user_id = auth()->user()->id;
        return view('review.create', ['review' => $review, 'book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Review::class);

        //$request->merge(['reviewed_on' => now()]);
        $validated = $request->validate([
            'book_id' => ['required'],
            'user_id' => ['required'],           
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'comment' => ['required','min:5', 'max:1000'],            
        ]);
    
        $book = Book::find($request['book_id']);
        $review = $book->reviews()->create($validated);  
             
        return redirect()->route("books.show", ['id'=>$review->book_id])
                         ->with('success', "Review Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {       
        $review = Review::find($id);
        if (!$review) {
            return redirect()->route("books.index")
                             ->with('warning', "Review does not exist");
        }
        return view ('review.show', ['review' => $review]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return redirect()->route("books.index" )->with('error', "Review Not Found");
        }

        $this->authorize('delete', $review);

        $book = $review->book;
        $review->delete();
        return redirect()->route("books.show", ['id'=>$book->id])
                         ->with('success', "Review Destroyed Successfully");   
       }
}
