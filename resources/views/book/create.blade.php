<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Create Book</h1>       
    </div>
       
    <x-ui.card>
        <x-slot:title>Create Book</x-slot:title>

        <livewire:book-component :categories="$categories" :authors="$authors" />     
    </x-ui.card>

</x-layout>



