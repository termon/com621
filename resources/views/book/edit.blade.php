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

        <livewire:book-component :book="$book" :categories="$categories" :authors="$authors" />        

    </x-ui.card>

</x-layout>
