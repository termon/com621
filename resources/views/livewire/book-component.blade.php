<form  wire:submit="save" enctype="multipart/form-data">
    @csrf

    <div class="p-3  rounded-lg">               
        <input name="form.id" type="hidden" wire:model='form.id'>

        <x-ui.form.input-group label="Title" name="form.title" wire:model='form.title' class="mb-4"/>
       
        <div class="flex flex-row gap-4 mb-4">  
            <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
            <x-ui.form.input-group label="Year" name="form.year" wire:model='form.year' class="flex-1"/>
            <x-ui.form.select-group label="Category" name="form.category_id"  value="{{$form->category_id}}" :options="$form->categories"  wire:model="form.category_id" class="flex-1"/>
        </div>
         
        <div class="flex justify-between items-center" >  
            <x-ui.form.label>Authors</x-ui.form.label>         
            <x-ui.link wire:click="addAuthor" class="flex gap-1 items-center cursor-pointer">
                <x-ui.svg.plus/>Add
            </x-ui.link>
        </div>

         <div class="flex gap-1 items-center border rounded p-3 mb-4">
            @foreach($form->book_authors as $i => $id)                
                <div class="flex gap-1">  
                    <x-ui.form.select-group :options="$this->form->authors" name="form.authors.{{$i}}" wire:model='form.book_authors.{{$i}}' class="mb-0"/> 
                    <x-ui.button type="button" variant="link" wire:click.prevent="removeAuthor({{$id}})"><x-ui.svg.trash/></x-ui.button>
                </div>
            @endforeach
            {{-- display general book-authors error - min/max authors --}}
            <x-ui.form.error name="form.book_authors" />
        </div>

        <x-ui.form.textarea-group label="Description" name="form.description" rows="8" value="" wire:model='form.description' class="mb-4"/>
        
        <div class="flex justify-between mb-4">
            <x-ui.form.input-file-group label="Image" name="form.image_file" wire:model="form.image_file" />
            @if ($form->image_file) 
                <img src="{{ $form->image_file->temporaryUrl() }}" class="w-64">
            @elseif ($form->image)
                <img src="{{$form->image}}" class="w-64">
            @endif
        </div>

        <div class="flex-1 items-center">
            <x-ui.button variant="dark">Save</x-ui.button>             
            <x-ui.link variant="light" href="{{ route('books.index') }}">Cancel</x-ui.link>
        </div>
    </div>
    
</form>

