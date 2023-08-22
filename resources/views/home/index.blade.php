
<x-layout>
    <x-slot:title>Home</x-slot:title>

    <h1 class="text-2xl text-blue-800">{{ $model->title}} </h1>

    {{-- <p class="text-gray-700 my-4">Topics to be covered will include </p> --}}
    <div class="flex gap-2 mt-3">
        @foreach($model->topics as $topic)
            <span class="bg-green-200 p-3 rounded-md">{{ $topic }}</span>
        @endforeach
    </div>
    
    <div class="mt-4">
        <x-base.button mode="blue">Button</x-base.button>
        <x-base.button mode="red">Button</x-base.button>
        <x-base.button mode="green">Button</x-base.button>
        <x-base.button mode="yellow">Button</x-base.button>
        <x-base.button mode="dark">Button</x-base.button>
        <x-base.button mode="light">Button</x-base.button>
        <x-base.button mode="oblue">Button</x-base.button>
        <x-base.button mode="ored">Button</x-base.button>
        <x-base.button mode="link">Button Link</x-base.button>
        <x-base.button mode="x">Invalid mode Button</x-base.button>
    </div>
    <div class="mt-5">
        <x-base.button mode="blue">Link</x-base.button>
        <x-base.button mode="red">Link</x-base.button>
        <x-base.button mode="green">Link</x-base.button>
        <x-base.button mode="yellow">Link</x-base.button>
        <x-base.button mode="dark">Link</x-base.button>
        <x-base.button mode="light">Link</x-base.button>
        <x-base.button mode="oblue">Link</x-base.button>
        <x-base.button mode="ored">Link</x-base.button>
        <x-base.button mode="link">Link</x-base.button>
        <x-base.button mode="x">Invalid mode Link</x-base.button>
    </div>
</x-layout>
