<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Create Book</h1>       
    </div>
       
    <x-ui.card>
        <x-slot:title>Create Book</x-slot:title>
        <form  method="post" action="{{ route('books.store') }}" enctype="multipart/form-data">
            @csrf
        
            @include("book._inputs")
        
            <div class="flex-1 items-center">
                <x-ui.button mode="dark">Create</x-ui.button>             
                <x-ui.link mode="light" href="{{ route('books.index') }}">Cancel</x-ui.link>
            </div>    
        </form>
        {{-- <livewire:book-component :categories="$categories" :authors="$authors" />      --}}
    </x-ui.card>

</x-layout>



