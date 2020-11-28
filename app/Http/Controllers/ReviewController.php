<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::get();
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
