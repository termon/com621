<x-layout>
    <x-slot:title>Book Details</x-slot:title>

    <x-base.breadcrumb class="my-3" :crumbs="[
            'Home' => route('home'), 
            'Books' => route('books.index'), 
            $book->title => '',
        ]" 
    />

   

    <x-base.card>
        <!-- title -->
        <x-slot:title>
            <span>Book</span>
            <x-base.badge>{{ $book->category->name }}</x-base.badge>

        </x-slot:title>

        <!-- Title and Year -->   
        <div>
            <span class="text-2xl text-blue-900">{{ $book->title }}</span> -
            <span class="text-lg">{{ $book->year }}</span>          
        </div>        
    
        <!-- author and rating -->
        <div class="my-2">
            <x-base.badge type="yellow">{{ $book->author }}</x-base.badge>
            <x-base.badge type="green">{{ $book->rating }}</x-base.badge>
        </div>

        <!-- description -->
        <p class="text-md text-gray-600">{{ $book->description }}</p>

        <!-- actions -->
        <x-slot:footer>
            <div class="flex justify-end space-x-5 items-center">
                <!-- delete confirmation modal -->
                @include('book._delete')
                <!-- delete note form m-0 -->
                {{-- <form method="POST" action="/books/{{$book->id}}" class="m-0">
                    @csrf()
                    @method('DELETE')
                    <x-base.button type="submit" type="danger">Delete</x-base.button>   
                </form> --}}
               
                <!-- edit -->
                <x-base.link href="{{ route('books.edit',['id'=>$book->id]) }}" class="flex gap-2" > 
                    <span>Edit</span><x-svg.edit class=""></x-svg.edit>
                </x-base.link>
                <!-- index -->
                <x-base.link href="{{ route('books.index') }}" class="flex gap-2"> 
                    <span>List</span><x-svg.list class=""></x-svg.list>
                </x-base.link>
            </div>
        </x-slot:footer>
    </x-base.card>  
</x-layout>

