<x-layout>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Create Book</h1>       
    </div>
       
    <x-ui.card>
        {{-- <x-slot:title>Create Book</x-slot:title> --}}

        <form  method="POST" action="{{ route('books.store') }}">
            @csrf
        
            <div class="p-3  rounded-lg">           
                
                @include("book._inputs")

                <div class="flex items-center gap-2 mt-2">
                    <x-ui.button mode="dark">Create</x-ui.button>             
                    <x-ui.link mode="light" href="{{ route('books.index') }}">Cancel</x-ui.link>
                </div>
                
            </div>
        </form>
    </x-ui.card>
</x-layout>
