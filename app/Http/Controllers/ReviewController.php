<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use App\Repositories\ReviewRepository;


class ReviewController extends Controller
{
    public function __construct(private ReviewRepository $repo, private BookRepository $bookRepo) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new review for specified book.
     */
    public function create($id)
    {
        $book = $this->bookRepo->find($id);
        if (!isset($book)) {
            return redirect()->route('books.index')->with('warning', "Book {$id} does not exist!");
        }
        $review = new Review;
        $review->book_id = $id;

        return view('review.create', ['review' => $review, 'book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$request->merge(['reviewed_on' => now()]);
        $review = $request->validate([
            'book_id' => ['required'],
            'name' => ['required'],            
            'rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'comment' => ['required','min:5', 'max:1000'],
            //'reviewed_on' => ['required']
        ]);
        
        Review::create($review);
        return redirect()->route("books.show", ['id'=>$request->book_id])->with('success', "Review Created Successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {       
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
    public function destroy(Review $review)
    {
       $book_id = $review->book_id;

       $review->delete();
       return redirect()->route("books.show", ['id'=>$book_id])->with('success', "Review Destroyed Successfully");
    }
}
