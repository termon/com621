
<x-layout>
    <x-slot:title>Home</x-slot:title>

    <h1 class="text-2xl text-blue-800">{{ $model->title}} </h1>

    {{-- <p class="text-gray-700 my-4">Topics to be covered will include </p> --}}
    <div class="flex gap-2 mt-3">
        @foreach($model->topics as $topic)
            <span class="bg-green-200 p-3 rounded-md">{{ $topic }}</span>
        @endforeach
    </div>
    
</x-layout>
