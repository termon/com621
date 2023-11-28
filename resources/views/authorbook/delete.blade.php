<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Remove Author</h1>       
    </div>
       
    <x-ui.card>
    
        <form method="post" action="{{ route('authorbooks.destroy', ['id'=>$book->id]) }}">
            @csrf
            @method('delete')
           
            <div class="flex gap-4 mb-4">  
                <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
                <x-ui.form.select-group label="Author" name="author_id" value="{{old('author_id')}}" :options="$authors" class="flex-1" />
             </div>

            <div class="flex items-center gap-2 mb-4">
                <x-ui.button  variant="dark">Remove</x-ui.button>             
                <x-ui.link variant="light" href="{{ route('books.show',['id' => $book->id]) }}">Cancel</x-ui.link>
            </div>
                
        </form>
    </x-ui.card>
</x-layout>
