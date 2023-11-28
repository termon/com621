<x-layout>

    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'), 
        'Books' => route('books.index'), 
        $book->id => route('books.show', ['id' => $book->id]),
        'Edit' => ''
        ]" 
    />

    <x-ui.card>
        <x-slot:title>Edit Book</x-slot:title>
        
        {{-- <form  method="post" action="{{ route('books.update', ['id' => $book->id]) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
        
            <input name="id" type="hidden" wire:model='id'>
            @include("book._inputs")
            <div class="flex-1 items-center">
                <x-ui.button  variant="dark">Save</x-ui.button>             
                <x-ui.link variant="light" href="{{ route('books.show', ['id' => $book->id]) }}">Cancel</x-ui.link>
            </div>
            
        </form> --}}
        
        <livewire:book-component :book="$book" :categories="$categories" :authors="$authors" />

    </x-ui.card>

</x-layout>
