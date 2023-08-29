<x-layout>
    <x-slot:title>Book Details</x-slot:title>

    <x-ui.breadcrumb class="my-3" :crumbs="[
            'Home' => route('home'), 
            'Books' => route('books.index'), 
            $book->title => '',
        ]" 
    />

    <!-- Book Card -->
    <x-ui.card class="py-2">
        <x-slot:title class="flex items-center justify-between">
            <h2 class="text-xl font-bold leading-tight mb-3">
                Book Details
            </h2>

            <x-ui.link href="{{route('books.index')}}" class="flex gap-2 items-center">
                <x-ui.svg.arrow direction="left"></x-ui.svg.arrow>Back
            </x-ui.link>
        </x-slot:title>

        <div class="flex justify-between">
            <div class="flex gap-2 items-center">
                <h2 class="text-lg font-bold leading-tight">{{$book->title}}</h2>
                <span>by</span>
                <div class="flex gap-1">   
                    @forelse ($book->authors as $author )
                        <h3 class="text-green-800 font-semibold">{{ $author->name }}, </h3>    
                    @empty
                        <h3 class="text-red-800 font-semibold">Unknown</h3>    
                    @endforelse
                </div>
                
                <x-ui.badge mode="pink">{{$book->rating}}</x-ui.badge>
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
                @include('book._delete') 
          
                <!-- edit -->
                <x-ui.link href="{{ route('books.edit',['id'=>$book->id]) }}" class="flex gap-2" > 
                    <span>Edit</span><x-ui.svg.edit class=""></x-ui.svg.edit>
                </x-ui.link>
                
            </div>
        </x-slot:footer>
        
    </x-ui.card>

    <x-ui.card class="mt-4">
        <x-slot:title class="flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center">
                <span>Reviews</span> 
                <x-ui.badge mode="green">{{$book->reviews->count()}}</x-ui.badge>
            </div>
            <x-ui.link mode="link" href="{{route('reviews.create', ['id'=>$book->id])}}" class="flex gap-1">
                <span>Add</span> <x-ui.svg.plus/>
            </x-ui.link>
        </x-slot:title>
 
        @include('book._reviews')
    </x-ui.card>

</x-layout>

