
<x-layout>
    <x-slot:title>Home</x-slot:title>

    <h1 class="text-2xl text-blue-800">{{ $model->title}} </h1>

    {{-- <p class="text-gray-700 my-4">Topics to be covered will include </p> --}}
    <div class="flex gap-2 mt-3">
        @foreach($model->topics as $topic)
            <span class="bg-green-200 p-3 rounded-md">{{ $topic }}</span>
        @endforeach
    </div>
    
    <div>
        <x-base.button type="blue">Button</x-base.button>
        <x-base.button type="red">Button</x-base.button>
        <x-base.button type="green">Button</x-base.button>
        <x-base.button type="yellow">Button</x-base.button>
        <x-base.button type="dark">Button</x-base.button>
        <x-base.button type="light">Button</x-base.button>
        <x-base.button type="oblue">Button</x-base.button>
        <x-base.button type="ored">Button</x-base.button>
        <x-base.button type="link">Button Link</x-base.button>
        <x-base.button>No type Button</x-base.button>
    </div>
    <div class="mt-5">
        <x-base.button type="blue">Link</x-base.button>
        <x-base.button type="red">Link</x-base.button>
        <x-base.button type="green">Link</x-base.button>
        <x-base.button type="yellow">Link</x-base.button>
        <x-base.button type="dark">Link</x-base.button>
        <x-base.button type="light">Link</x-base.button>
        <x-base.button type="oblue">Link</x-base.button>
        <x-base.button type="ored">Link</x-base.button>
        <x-base.button type="link">Link</x-base.button>
        <x-base.button>No type Link</x-base.button>
    </div>
</x-layout>
