<!-- Modal to handle adding an author to a book -->

<!-- button uses alpine to trigger display of the model -->
<x-ui.button variant="link" x-data="" class="flex gap-1"
    x-on:click.prevent="$dispatch('open-modal', 'confirm-authorbook-create')">
    <x-ui.svg.plus><span>Add Author</span></x-ui.svg.plus>
</x-ui.button>

<!-- the actual modal containing the forl -->
<x-ui.modalcenter name="confirm-authorbook-create" focusable>
    <x-slot:title>
        <h3>Add Author</h3>
    </x-slot:title> 
    <form  method="POST" action="{{ route('authorbooks.store', ['id'=>$book->id]) }}">
        @csrf
        <input name="book_id" type="hidden" value="{{$book->id}}">
                       
        <div class="flex gap-4 mb-4">  
            <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
            <x-ui.form.select-group name="author_id" 
                                    value="{{old('author_id')}}" 
                                    :options="$book->getAddAuthorSelectList(true)" 
                                    class="flex-1" />
         </div>

        <div class="flex items-center gap-2 mb-4">
            <x-ui.button  variant="dark">Add</x-ui.button>             
            <x-ui.link href="{{ route('books.show',['id' => $book->id]) }}">Cancel</x-ui.link>
        </div>    
    </form>
   
</x-ui.modalcenter>