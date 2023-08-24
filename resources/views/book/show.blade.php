<x-layout>
    <x-slot:title>Book Details</x-slot:title>

    <x-base.breadcrumb class="my-3" :crumbs="[
            'Home' => route('home'), 
            'Books' => route('books.index'), 
            $book->title => '',
        ]" 
    />

    <!-- delete note form m-0 -->
        {{-- <form method="POST" action="/books/{{$book->id}}" class="m-0">
            @csrf()
            @method('DELETE')
            <x-base.button type="submit" mode="danger">Delete</x-base.button>   
        </form> --}}
    {{-- <x-base.card>
        <!-- title -->
        <x-slot:title class="flex items-center justify-between">
            <div>
                <span>Book</span>
                <x-base.badge mode="blue">{{ $book->category->name }}</x-base.badge>     
            </div>
            <div class="flex gap-2 items-center text-xs">                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                <span>Back</span>
            </div>
    
        </x-slot:title>

        <!-- Title and Year -->   
        <div>
            <span class="text-2xl text-blue-900">{{ $book->title }}</span> -
            <span class="text-lg">{{ $book->year }}</span>          
        </div>        
    
        <!-- author and rating -->
        <div class="my-2">
            <x-base.badge mode="yellow">{{ $book->author }}</x-base.badge>
            <x-base.badge mode="green">{{ $book->rating }}</x-base.badge>
        </div>

        <!-- description -->
        <p class="text-md text-gray-600">{{ $book->description }}</p>

        <!-- actions -->
        <x-slot:footer>
            <div class="flex justify-end space-x-5 items-center">
                <!-- delete confirmation modal -->
                @include('book._delete')
          
               
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
    </x-base.card>   --}}

    <x-base.card class="py-2">
        <x-slot:title class="flex items-center justify-between">
            <h2 class="text-xl font-bold leading-tight mb-3">
                Book Details
            </h2>

            <x-base.link href="{{route('books.index')}}" class="flex gap-2 items-center">
                <x-svg.arrow direction="left"></x-svg.arrow>
                
                Back
            </x-base.link>
        </x-slot:title>

        <div class="flex justify-between">
            <div class="flex gap-2 items-center">
                <h2 class="text-lg font-bold leading-tight">{{$book->title}}</h2>
                <span>by</span>
                <h3 class="text-green-800 font-semibold">{{ $book->author }}</h3>
                <x-base.badge mode="pink">{{$book->rating}}</x-base.badge>
            </div>

            <div class="text-blue-800 font-bold">{{$book->year}}</div>
        </div>

        <div class="mt-2 text-gray-600">
            <p class="">{{$book->description}}</p>
        </div>

          <!-- actions -->
          <x-slot:footer>
            <div class="flex justify-end space-x-5 items-center">
                <!-- delete confirmation modal -->
                {{-- @include('book._delete') --}}
          
                <x-base.link href="{{ route('books.edit',['id'=>$book->id]) }}" > 
                    <span>Edit</span>
                </x-base.link>
                <x-base.link href="{{ route('books.edit',['id'=>$book->id]) }}" > 
                    <span>Delete</span>
                </x-base.link>
                <!-- index -->
                
                <!-- edit -->
                {{-- <x-base.link href="{{ route('books.edit',['id'=>$book->id]) }}" class="flex gap-2" > 
                    <span>Edit</span><x-svg.edit class=""></x-svg.edit>
                </x-base.link>
                <!-- index -->
                <x-base.link href="{{ route('books.index') }}" class="flex gap-2"> 
                    <span>List</span><x-svg.list class=""></x-svg.list>
                </x-base.link> --}}
            </div>
        </x-slot:footer>
        
    </x-base.card>

</x-layout>

