<form  wire:submit="save" enctype="multipart/form-data">
    @csrf

    <div class="p-3  rounded-lg">               
        <input name="id" type="hidden" wire:model='id'>

        <x-ui.form.input-group label="Title" name="title" value="" wire:model='title' class="mb-4"/>
       
        <div class="flex flex-row gap-4 mb-4">  
            <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
            <x-ui.form.input-group label="Year" name="year" value="" wire:model='year' class="flex-1"/>
            {{-- <x-ui.form.input-group label="Rating" name="rating" type="number" step="0.1" value="" wire:model='rating' class="flex-1 "/> --}}
            <x-ui.form.select-group label="Category" name="category_id"  value="{{$category_id}}" :options="$categories"  wire:model="category_id" class="flex-1"/>
        </div>
         
        <div class="flex justify-between items-center" >  
            <x-ui.form.label>Authors</x-ui.form.label>         
            <x-ui.link wire:click="addAuthor" class="flex gap-1 items-center cursor-pointer">
                <x-ui.svg.plus/>Add
            </x-ui.link>
        </div>

         <div class="flex gap-1 items-center border rounded p-3 mb-4">
            @foreach($book_authors as $i => $id)                
                <div class="flex gap-1">  
                    <x-ui.form.select-group :options="$this->authors" name="authors.{{$i}}" wire:model='book_authors.{{$i}}' class="mb-0"/> 
                    <x-ui.button type="button" mode="link" wire:click="removeAuthor({{$id}})"><x-ui.svg.trash/></x-ui.button>
                </div>
            @endforeach
            {{-- display general book-authors error - min/max authors --}}
            <x-ui.form.error name="book_authors" />
        </div>

        <x-ui.form.textarea-group label="Description" name="description" rows="8" value="" wire:model='description' class="mb-4"/>
        
        <div class="flex justify-between mb-4">
            <x-ui.form.input-file-group label="Image" name="image_file" wire:model="image_file" />
            @if ($image_file) 
                <img src="{{ $image_file->temporaryUrl() }}" class="w-64">
            @elseif ($image)
                <img src="{{$image}}" class="w-64">
            @endif
        </div>

        <div class="flex-1 items-center">
            <x-ui.button mode="dark">Save</x-ui.button>             
            <x-ui.link mode="light" href="{{ route('books.index') }}">Cancel</x-ui.link>
        </div>
    </div>
    
</form>


