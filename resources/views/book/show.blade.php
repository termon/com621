<x-layout>
    <x-slot:title>Book</x-slot:title>


    <div>
{{--        <h1 class="text-3xl text-blue-900 mb-5">Book {{ $book->id }}</h1>--}}
        <h3 class="text-2xl text-blue-900">
            {{ $book->title }} -
            <span class="text-lg">{{ $book->year }}</span>
            <span class="text-sm bg-pink-300 px-2 rounded-lg">{{ $book->rating }}</span>
        </h3>

        <div class="text-sm text-gray-900 my-2">
            @foreach($book->authors as $author)
                <span class="mr-1 p-1 bg-yellow-100 rounded hover:bg-yellow-200">
                    <a href="/authors/{{$author->id}}">{{ $author->name }}</a>
                </span>
            @endforeach
        </div>

        <p class="text-md text-gray-600">{{ $book->description }}</p>
    </div>


    @include('book._reviews')
    

    {{--    <x-slot:title>Book {{$book->id}}</x-slot:title>--}}

{{--    <div class="flex flex-wrap gap-3">--}}
{{--        <div class="bg-blue-50 p-4 rounded shadow-lg">--}}
{{--            <div class="flex flex-col space-around gap-2">--}}
{{--                <div class="flex place-content-between">--}}
{{--                    <h3 class="font-bold">--}}
{{--                        {{ $book->title}} [{{$book->category->name}}]--}}
{{--                    </h3>--}}
{{--                    <a href="/book">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />--}}
{{--                        </svg>--}}
{{--                    </a>--}}
{{--                </div>--}}


{{--                <h5 class="text-sm text-green-700 font-semibold">--}}
{{--                    {{ $book->author }}--}}
{{--                    <span class="p-2 rounded-xl bg-yellow-100 text-xs">{{ $book->year}}</span>--}}
{{--                    <span class="p-2 rounded-xl bg-red-100 text-xs">{{$book->rating}}</span>--}}
{{--                </h5>--}}

{{--                <p>{{$book->description}}</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</x-layout>
