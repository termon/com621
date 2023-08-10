<x-layout>
    <x-slot:title>Books</x-slot:title>
    <h1 class="text-3xl text-blue-900 mb-5">Books</h1>
    <div>
        @foreach($books as $book)
            <div class="mb-3 p-1 rounded-md bg-gray-50 ">
                <div>
                    <span class="text-xl text-blue-900 hover:text-blue-600">
                        <a href="/books/{{$book->id}}"> {{ $book->title}}</a>
                    </span>

                    <span class="text-sm text-gray-900 my-2">
                        @foreach($book->authors as $author)
                            <span class="mr-1 p-1 bg-yellow-100 rounded hover:bg-yellow-200">
                                <a href="/authors/{{$author->id}}">{{ $author->name }}</a>
                             </span>
                        @endforeach
                    </span>

                    <span class="p-1 bg-green-200 rounded text-xs text-green-900">
                        <span>Rating:</span>
                        <span>{{$book->rating}}</span>
                        <span>({{$book->reviews->count()}} reviews)</span>
                    </span>

                </div>
            </div>
        @endforeach

    </div>
</x-layout>

