<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Services\ReviewService;


class ReviewController extends Controller
{
    public function __construct(private ReviewService $Service, private BookService $bookService) {}

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
    public function create($id, Review $review)
    {
        
        $book = $this->bookService->find($id);
        if (!isset($book)) {
            return redirect()->route('book.index')->with('warning', "Book {$id} does not exist!");
        }
        
        $review->book_id = $id;
        $review->user_id = auth()->user()->id;
        return view('reviews.create', ['review' => $review, 'book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$request->merge(['reviewed_on' => now()]);
        $review = $request->validate([
            'book_id' => ['required'],
            'user_id' => ['required'],
            //'name' => ['required'],            
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'comment' => ['required','min:5', 'max:1000'],
            //'reviewed_on' => ['required']
        ]);
        $review['reviewed_on'] = now();
        $review = Review::create($review);       
        return redirect()->route("books.show", ['id'=>$review->book_id])
                         ->with('success', "Review Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {       
        return view ('reviews.show', ['review' => $review]);
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
    public function destroy(Review $review)
    {
       $book_id = $review->book_id;

       $review->delete();
       return redirect()->route("books.show", ['id'=>$book_id])
                        ->with('success', "Review Destroyed Successfully");
    }
}
