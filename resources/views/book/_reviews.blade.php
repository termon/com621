<div class="mt-3">
    <h3 class="mt-4 text-2xl text-blue-800">Reviews</h3>
    @foreach($book->reviews as $review)
        <div class="p-2 mt-3 bg-gray-100 rounded-xl">
            <h4 class="text-md font-normal">
                {{$review->name}}
                <span class="text-sm text-blue-700">{{$review->reviewed_on->diffForHumans()}}</span>
            </h4>
            <div class="text-sm text-gray-600 mt-1">{{$review->comment}}</div>
        </div>
    @endforeach
</div>
