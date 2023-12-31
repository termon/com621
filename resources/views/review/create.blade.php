<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Add Book Review</h1>       
    </div>
       
    <x-ui.card>
        <x-slot:title>
            <span class="mr-2">For {{$book->title}}</span>
            <x-ui.badge>{{$book->category->name}}</x-ui.badge>
        </x-slot:title>

        <form  method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input name="book_id" type="hidden" value="{{$review->book_id}}">
            <input name="user_id" type="hidden" value="{{$review->user_id}}">
                             
            <div class="flex gap-4">  
                <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
                {{-- <x-ui.form.input-group label="Name" name="name" value="{{  old('name', $review->name) }}" class="flex-1" />  --}}
                <x-ui.form.input-group label="Rating" name="rating" value="{{  old('rating', $review->rating) }}" type="number" step="0.1" class="flex-1"/>
            </div>

            <x-ui.form.textarea-group label="Comment" name="comment" rows="8" value="{{  old('comment', $review->comment) }}" />
            
            <div class="flex items-center gap-2 mt-2">
                <x-ui.button variant="dark">Create</x-ui.button>             
                <x-ui.link variant="light" href="{{ route('books.show',['id' => $review->book_id]) }}">Cancel</x-ui.link>
            </div>
                
        </form>
    </x-ui.card>
</x-layout>
