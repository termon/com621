<x-layout>

    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'), 
        'Books' => route('books.index'), 
        $book->id => route('books.show', ['id' => $book->id]),
        'Edit' => ''
    ]" 
/>

    {{-- <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Edit Book</h1>       
    </div> --}}

    <x-ui.card>
        <x-slot:title>Edit Book</x-slot:title>

        <livewire:book-component :book="$book" :categories="$categories" :authors="$authors" />        

    </x-ui.card>

</x-layout>
