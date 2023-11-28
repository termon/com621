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
                
                <x-ui.badge variant="pink">{{$book->rating}}</x-ui.badge>
            </div>

            <div class="text-blue-800 font-bold">{{$book->year}}</div>
        </div>

        <div class="mt-4 text-gray-600 flex justify-between">
            <p class="">{{$book->description}}</p>
            @if($book->image)
                <img src="{{$book->image}}  " class="w-96">
                {{-- <img src="{{Storage::url($book->image)}}" class="w-96"> --}}
            @endif     
            {{-- <img src="{{$book->getFirstMediaUrl('public')}}" class="w-96">  --}}
        </div>

          <!-- actions -->
          <x-slot:footer>
            <div class="flex flex-wrap justify-end space-x-5 items-center">
                <!-- delete confirmation modal -->
                @include('book._delete') 
          
                <!-- edit -->
                <x-ui.link href="{{ route('books.edit',['id'=>$book->id]) }}" class="flex gap-1" > 
                    <x-ui.svg.edit><span>Edit</span></x-ui.svg.edit>
                </x-ui.link>

                <!-- nav links to separate authorbook management pages -->
                {{-- <x-ui.link href="{{ route('authorbooks.create',['id'=>$book->id]) }}" class="flex gap-1" > 
                    <x-ui.svg.plus><span>Add Author</span></x-ui.svg.plus>
                </x-ui.link>
                <x-ui.link href="{{ route('authorbooks.delete',['id'=>$book->id]) }}" class="flex gap-1" > 
                    <x-ui.svg.trash><span>Remove Author</span></x-ui.svg.trash>
                </x-ui.link> --}}

                <!-- modals displaying authorbook management forms -->
                @include('authorbook._create')
                @include('authorbook._delete') 
                
            </div>
        </x-slot:footer>
        
    </x-ui.card>

    <x-ui.card class="mt-4">
        <x-slot:title class="flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center">
                <span>Reviews</span> 
                <x-ui.badge variant="green">{{$book->reviews->count()}}</x-ui.badge>
            </div>

            @can('create', App\Models\Review::class)            
                <x-ui.link class="flex gap-1"
                           href="{{route('reviews.create', ['id'=>$book->id])}}">
                    <span>Add</span> <x-ui.svg.plus/>
                </x-ui.link>
            @endcan

        </x-slot:title>
 
        @include('book._reviews')
    </x-ui.card>

</x-layout>

