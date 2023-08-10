<x-layout>
    <x-slot:title>Books</x-slot:title>

    <h1 class="text-3xl text-blue-900 mb-5">Books</h1>
    {{-- <div class="flex flex-wrap gap-3"> --}}
{{--    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-3">--}}
   <div>
    @foreach($repo->all() as $book)
           <div class="mb-3">
               <h3 class="text-2-xl text-blue-900">
                   <a href="/books/{{$book->id}}">{{ $book->title}}</a>
               </h3>
               <p class="text-sm text-gray-500">{{ $book->description }}</p>
           </div>

           {{--        <div class="bg-blue-50 p-4 rounded shadow-lg">--}}
{{--            <div class="flex gap-2 items-center">--}}
{{--                <h3 class="font-semibold">--}}
{{--                    <a href="/book/{{$book->id}}">{{ $book->title}}</a>--}}
{{--                </h3>--}}
{{--                <span class="p-2 rounded-xl bg-yellow-100 text-xs">{{ $book->year}}</span>--}}
{{--            </div>--}}
{{--            <h5 class="text-sm text-gray-800 ">{{ $book->author }}</h5>--}}
{{--            <p class="text-xs text-gray-500">{{$book->snippet}}</p>--}}
{{--        </div>--}}
    @endforeach
    </div>
</x-layout>
