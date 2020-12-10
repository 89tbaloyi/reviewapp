@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
    <form action="{{route('reviews')}}" method="POST" class="mb-4">
        @csrf
        <div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
            border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
            placeholder="Post a Review"></textarea>

            @error('body')
                 <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded
            font-medium">Send</button>
        </div>

    </form>
    @if($reviews->count())
     @foreach($reviews as $review)
     <div class="mb-4">
     <a href="" class="font-bold">{{$review->user->name}} </a><span class="text-gray-600
     text-sm">{{$review->created_at->diffForHumans()}}</span>
     <p class="mb-2">{{$review->body}}</p>
     @if(!$review->ownedBy(auth()->user()))
     <div>
             
     <form action="{{route('reviews.destroy', $review)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500">Delete</button> 
        </form>
     </div>
     @endif
     <div class="flex items-center">
        @auth
         @if(!$review->likedBy(auth()->user()))
        
     <form action="{{route('reviews.likes', $review)}}" method="POST" class="mr-1">
             @csrf
             <button type="submit" class="text-blue-500">Like</button>
         </form>
         @else

         <form action="{{route('reviews.likes', $review)}}" method="POST" class="mr-1">
             @csrf
             @method('DELETE')
            <button type="submit" class="text-blue-500">Unlike</button>
        </form>
       
        @endif
        
        @endauth

    <span>{{$review->likes->count()}} {{ Str::plural('like', $review->likes->count())}}</span>
     </div>
     </div>
     @endforeach
     {{$reviews->links()}}
    @else 
      <p>No reviews</p>
    @endif
    </div>

</div>
@endsection