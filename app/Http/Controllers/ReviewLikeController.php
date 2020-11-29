<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;


class ReviewLikeController extends Controller
{
//     public function __construct()
// {
//     $this->middleware('auth');
// }
   public function store(Review $review, Request $request) 
   {

    if($review->likedBy($request->user()))
    {
        return response(null);
    }

    $review->likes()->create([
        'user_id' => $request->user()->id,
    ]);
        return back();
   }
   public function destroy(Review $review, Request $request)
   {
       $request->user()->likes()->where('review_id', $review->id)->delete();
       return back();

   }
}
