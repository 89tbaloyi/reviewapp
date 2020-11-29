<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller

{
//     public function __construct()
// {
//     $this->middleware('auth');
// }
    public function index()
    {
        $reviews = Review::paginate(2);
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
}
