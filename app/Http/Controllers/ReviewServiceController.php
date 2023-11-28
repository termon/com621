<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\BookService;
use App\Http\Requests\ReviewStoreRequest;

class ReviewServiceController extends Controller
{

    public function __construct(private BookService $service) {}
    
    /**
     * Show the form for creating a new review for specified book.
     * DI will auto-create a new Review model for population
     */
    public function create($id, Review $review) { 
        
        $this->authorize('create', Review::class);
       
        $book = $this->service->findBook($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        // populate
        $review->book_id = $id;
        $review->user_id = auth()->user()->id;
        return view('review.create', ['review' => $review, 'book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewStoreRequest $request)
    {
        $this->authorize('create', Review::class);

        //$request->merge(['reviewed_on' => now()]);
        $validated = $request->validated();
    
        // call service
        $review = $this->service->addReviewToBook($validated['book_id'], $validated);  
             
        return redirect()->route("books.show", ['id'=>$review['book_id']])
                         ->with('success', "Review Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {       
        $review = $this->service->findReview($id);
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
        $review = $this->service->findBook($id);
        if (!$review) {
            return redirect()->route("books.index" )->with('error', "Review Not Found");
        }

        $this->authorize('delete',$review);

        $book = $this->service->deleteReviewFromBook($id);
        
        return redirect()->route("books.show", ['id'=>$book->id])
                         ->with('success', "Review Destroyed Successfully");   
       }
}
