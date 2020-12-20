<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller

{
    public function __construct()
{
    $this->middleware('auth')->except(['index']);
}
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->with(['user','likes'])->paginate(2);
        return view('reviews.index', [
            'reviews' => $reviews
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
          'body' => 'required'
        ]);

        $request->user()->reviews()->create([
            'body' => $request->body
        ]);
        return back();
    }

    public function destroy(Review $review, Request $request)
    {
       
        $review->delete();
        return back();
    }
}
