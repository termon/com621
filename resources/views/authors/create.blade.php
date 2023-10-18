<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Create Author</h1>       
    </div>
       
    <x-ui.card>
        {{-- <x-slot:title>Create Book</x-slot:title> --}}

        <form  method="POST" action="{{ route('authors.store') }}">
            @csrf
            <input name="book_id" type="hidden" value="{{$review->book_id}}">
                           
            <div class="flex gap-4">  
                <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
                <x-ui.form.select-group label="Name" name="name" value="{{ $author->name }}" options="" class="flex-1" />
             </div>

            <x-ui.form.textarea-group label="Comment" name="comment" rows="8" value="{{ $review->comment }}" />
            
            <div class="flex items-center gap-2 mt-2">
                <x-ui.button mode="dark">Create</x-ui.button>             
                <x-ui.link mode="light" href="{{ route('books.show',['id' => $review->book_id]) }}">Cancel</x-ui.link>
            </div>
                
        </form>
    </x-ui.card>
</x-layout>
