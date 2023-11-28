<x-ui.button variant="link" x-data="" class="flex gap-1"
    x-on:click.prevent="$dispatch('open-modal', 'confirm-authorbook-deletion')">
    <x-ui.svg.trash><span>Remove Author</span></x-ui.svg.trash>
</x-ui.button>

<x-ui.modalcenter name="confirm-authorbook-deletion" focusable>
    <x-slot:title>
        <h3>Remove Author</h3>
    </x-slot:title> 
    
    <form method="post" action="{{ route('authorbooks.destroy', ['id'=>$book->id]) }}">
        @csrf
        @method('delete')
       
        <div class="flex gap-4 mb-4">  
            <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
            <x-ui.form.select-group name="author_id" 
                                    value="{{old('author_id')}}" 
                                    :options="$book->getRemoveAuthorSelectList(false)"  
                                    class="flex-1" />
         </div>

        <div class="flex items-center gap-2 mb-4">
            <x-ui.button variant="dark">Remove</x-ui.button>             
            <x-ui.link variant="light" href="{{ route('books.show',['id' => $book->id]) }}">Cancel</x-ui.link>
        </div>
            
    </form>
   
</x-ui.modalcenter>