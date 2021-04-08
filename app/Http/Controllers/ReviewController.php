<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Books;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('review');
    }


    public function getBookReview(Request $request)
    {   
        $comment = Books::getDataBook($request->get('isbn'));
        $book = Books::getGoogleBook($request->get('isbn'));
        $review = Review::getBookReview($request->get('isbn'));
        
        if($comment)
        {
            $listcomments = Comment::getComments($comment->bookId);
            $listRatings = Rating::getRatings($comment->bookId);
            // dd($listRatings);
            // $relate = Books::getRelatedBook($comment->genre);
            return response()->json([$book, $review, $listcomments, $listRatings]);
            // $relate = Books::getRelatedBook($comment->genre);
            // return response()->json([$book,$review, $listcomments, $relate]);
        } else
        {
            return response()->json([$book,$review]);
        }
    }

    public function getRecommendation(Request $request)
    {
        $book = Books::getDatabook($request->get('isbn'));
        // dd($book);
        $relate = Books::getRelatedBook($book->genre);
        
        if($relate){
            return response()->json($relate);
        }
    }

    public function addComment(Request $request)
    {
        $book = Books::getDatabook($request->get('isbn'));
        $result = Comment::create([
                'userId' => Auth::id(),
                'bookId' => $book->bookId,
                'comment'=> $request->comment
        ]);
        if($result){
            // dd($result);
            $commenter = Comment::with(['user' => function($query) { 
                        $query->select('id', 'username');
                        }])->where('commentId', $result->id)->get();
            
            return response()->json($commenter);
        }
        return false;
    }

    public function addRating(Request $request)
    {
        $book = Books::getDatabook($request->get('isbn'));
        $rating = Rating::addRating($request->get('text'), $book->bookId);
        
        if($rating){
            // dd($rating);
            $ur = Rating::with(['user' => function($query) { 
                        $query->select('id', 'username');
                        }])->where('ratingId', $rating)->get();
            // dd($ur);
            return response()->json($ur);
        }
        return false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
