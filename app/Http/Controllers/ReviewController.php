<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Services\ReviewService;
use Illuminate\Support\Facades\Gate;


class ReviewController extends Controller
{
    public function __construct(private BookService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new review for specified book.
     * DI will auto-create a new Review model for population
     */
    public function create($id, Review $review, Request $request) { 

        // if (auth()->user()->cannot('create', Review::class)) {
        // if ($request->user()->cannot('create', Review::class)) {
        //    return redirect()->back()->with('warning', 'Not authorised'); 
        //}
        
        $this->authorize('create', Review::class);
       
        $book = $this->service->find($id);
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
        //$this->authorize('create');

        //$request->merge(['reviewed_on' => now()]);
        $review = $request->validate([
            'book_id' => ['required'],
            'user_id' => ['required'],           
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'comment' => ['required','min:5', 'max:1000'],            
        ]);
    
        $review = $this->service->addReview($review['book_id'], $review);  
             
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
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, int $id)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //$book = $this->service->deleteReview($id);

        $review = Review::find($id);
        if (!$review) {
            return redirect()->route("books.index" )->with('error', "Review Not Found");
        }
        $book = $review->book;
        $review->delete();
        return redirect()->route("books.show", ['id'=>$book->id])
                         ->with('success', "Review Destroyed Successfully");   
       }
}
