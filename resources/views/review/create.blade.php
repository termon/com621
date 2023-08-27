<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Create Book</h1>       
    </div>
       
    <x-base.card>
        {{-- <x-slot:title>Create Book</x-slot:title> --}}

        <form  method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input name="book_id" type="hidden" value="{{$review->book_id}}">
                           
            <div class="flex gap-4">  
                <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
                <x-form.input-group label="Author" name="name" value="{{ $review->name }}" class="flex-1" />
                <x-form.input-group label="Rating" name="rating" value="{{ $review->rating }}" type="number" step="0.1" class="flex-1"/>
            </div>

            <x-form.textarea-group label="Comment" name="comment" rows="8" value="{{ $review->comment }}" />
            
            <div class="flex items-center gap-2 mt-2">
                <x-base.button mode="dark">Create</x-base.button>             
                <x-base.link mode="light" href="{{ route('books.show',['id' => $review->book_id]) }}">Cancel</x-base.link>
            </div>
                
        </form>
    </x-base.card>
</x-layout>
