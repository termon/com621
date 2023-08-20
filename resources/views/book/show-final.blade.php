<x-layout>
    <x-slot:title>Book</x-slot:title>

    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Book</h1>
                  
        <form method="POST" action="/books/{{$book->id}}" class="flex justify-between gap-5 items-center">
            @csrf()
            @method('DELETE')

            <x-button href="/books/{{$book->id}}/edit"> 
                Edit
            </x-button>

            <x-button type="submit" type="danger">Delete</x-button>
            
        </form>    
        
    </div>

    <x-base.card>
        <div class="flex justify-between items-center pb-1">
            <div>
                <span class="text-2xl text-blue-900">{{ $book->title }}</span> -
                <span class="text-lg">{{ $book->year }}</span>          
            </div>
           <x-badge class="flex items-center gap-1">
                <x-svg.badge/> 
                <span>{{ $book->rating }}</-badge>
            </x-badge>          
        </div>

     
        <div class="text-sm text-gray-900 my-2">
            Author - <span class="mr-1 p-1 bg-yellow-100 rounded hover:bg-yellow-200">
                {{ $book->author }}
            </span>           
        </div>

        <p class="text-md text-gray-600">{{ $book->description }}</p>
    </x-base.card>

</x-layout>
