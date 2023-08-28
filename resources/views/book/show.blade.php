<x-layout>
    <x-slot:title>Book Details</x-slot:title>

    <x-base.breadcrumb class="my-3" :crumbs="[
            'Home' => route('home'), 
            'Books' => route('books.index'), 
            $book->title => '',
        ]" 
    />

    <!-- Book Card -->
    <x-base.card class="py-2">
        <x-slot:title class="flex items-center justify-between">
            <h2 class="text-xl font-bold leading-tight mb-3">
                Book Details
            </h2>

            <x-base.link href="{{route('books.index')}}" class="flex gap-2 items-center">
                <x-svg.arrow direction="left"></x-svg.arrow>Back
            </x-base.link>
        </x-slot:title>

        <div class="flex justify-between">
            <div class="flex gap-2 items-center">
                <h2 class="text-lg font-bold leading-tight">{{$book->title}}</h2>
                <span>by</span>
                <h3 class="text-green-800 font-semibold">{{ $book->author }}</h3>
                <x-base.badge mode="pink">{{$book->rating_formatted}}</x-base.badge>
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
                <x-base.link href="{{ route('books.edit',['id'=>$book->id]) }}" class="flex gap-2" > 
                    <span>Edit</span><x-svg.edit class=""></x-svg.edit>
                </x-base.link>
                
            </div>
        </x-slot:footer>
        
    </x-base.card>

    <x-base.card class="mt-4">
        <x-slot:title>
            Reviews 
            <x-base.link mode="link" href="{{route('reviews.create', ['id'=>$book->id])}}">Add</x-base.link>
        </x-slot:title>
 
        @include('book._reviews')
    </x-base.card>

</x-layout>

