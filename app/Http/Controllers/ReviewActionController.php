<?php

namespace App\Http\Controllers;

use App\Models\Review;

use Illuminate\Http\Request;

use App\Actions\Book\FindBookAction;
use App\Actions\Review\AddReviewAction;
use App\Actions\Review\FindReviewAction;
use App\Http\Requests\ReviewStoreRequest;
use App\Actions\Review\DeleteReviewAction;
use App\Data\ReviewData;

class ReviewActionController extends Controller
{

    /**
     * Show the form for creating a new review for specified book.
     * DI will auto-create a new Review model for population
     */
    public function create($id, Review $review, FindBookAction $findBook) { 
        
        $this->authorize('create', Review::class);
       
        $book = $findBook->execute($id);
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
    public function store(ReviewStoreRequest $request, AddReviewAction $addReview)
    {
        $this->authorize('create', Review::class);

        //$request->merge(['reviewed_on' => now()]);
        $validated = $request->validated();
    
        // call action
        $data = ReviewData::fromArray($validated);
        $review = $addReview->execute($data->book_id, $data);  
             
        return redirect()->route("books.show", ['id'=>$review['book_id']])
                         ->with('success', "Review Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, FindReviewAction $findReview)
    {       
        $review = $findReview->execute($id);
        if (!$review) {
            return redirect()->route("books.index")
                             ->with('warning', "Review does not exist");
        }
        return view ('review.show', ['review' => $review]);
    }

 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, FindReviewAction $findReview, DeleteReviewAction $deleteReview)
    {
        $review = $findReview->execute($id);
        if (!$review) {
            return redirect()->route("books.index" )->with('error', "Review Not Found");
        }

        $this->authorize('delete',$review);

        $book = $deleteReview->execute($id);
        
        return redirect()->route("books.show", ['id'=>$book->id])
                         ->with('success', "Review Destroyed Successfully");   
       }
}
