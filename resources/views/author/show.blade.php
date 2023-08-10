<x-layout>
    <x-slot:title>Author {{ $author->id }} </x-slot:title>

    <h1 class="text-3xl text-blue-900 mb-5">{{ $author->name }}</h1>

    @foreach($author->books as $book)
        <h3 class="text-2-xl text-blue-900 mb-2">
            <a href="/books/{{$book->id}}">{{ $book->title}} </a>
        </h3>
    @endforeach
</x-layout>
