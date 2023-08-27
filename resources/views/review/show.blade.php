<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Book Review</h1>       
    </div>
       
    <x-base.card>
        <x-slot:title class="flex items-center justify-between">
            <div>
            
                <div class="flex gap-1 items-center text-sm">
                    <h2 class="text-xl font-bold leading-tight me-4">
                        {{$review->book->title}}
                    </h2>
                    <span class="text-blue-800">{{ $review->reviewed_on_formatted }}</span>
                    <span>by</span>
                    <span class="text-green-800">{{ $review->name }}</span>
                </div>
            </div>

            <x-base.link href="{{route('books.show',['id'=>$review->book->id])}}" class="flex gap-2 items-center">
                <x-svg.arrow direction="left"></x-svg.arrow>Back
            </x-base.link>
        </x-slot:title>

        <div>{{$review->author}}</div>
        
        

        <div>{{$review->comment}}</div>

        <x-slot:footer>
            <form method="POST" action="{{route('reviews.destroy',['review'=>$review])}}" class="m-0">
                @csrf()
                @method('DELETE')
                <x-base.button type="submit" mode="red">Delete</x-base.button>   
            </form>
        </x-slot:footer>
    </x-base.card>
</x-layout>
