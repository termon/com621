
<x-layout>
    <x-slot:title>Home</x-slot:title>

    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => '', 
      ]" 
    />

    <h1 class="text-2xl text-blue-800">{{ $model->title}} </h1>

    <div class="flex gap-2 mt-3">
        @foreach($model->topics as $topic)
            <span class="bg-green-200 p-3 rounded-md">{{ $topic }}</span>
        @endforeach
    </div>
    
    <div class="mt-4">
        <x-ui.button mode="blue">Button</x-ui.button>
        <x-ui.button mode="red">Button</x-ui.button>
        <x-ui.button mode="green">Button</x-ui.button>
        <x-ui.button mode="yellow">Button</x-ui.button>
        <x-ui.button mode="dark">Button</x-ui.button>
        <x-ui.button mode="light">Button</x-ui.button>
        <x-ui.button mode="oblue">OButton</x-ui.button>
        <x-ui.button mode="ored">OButton</x-ui.button>
        <x-ui.button mode="link">Button Link</x-ui.button>
        <x-ui.button mode="x">Invalid mode Button</x-ui.button>
    </div>
    <div class="mt-5">
        <x-ui.button mode="blue">Link</x-ui.button>
        <x-ui.button mode="red">Link</x-ui.button>
        <x-ui.button mode="green">Link</x-ui.button>
        <x-ui.button mode="yellow">Link</x-ui.button>
        <x-ui.button mode="dark">Link</x-ui.button>
        <x-ui.button mode="light">Link</x-ui.button>
        <x-ui.button mode="oblue">OLink</x-ui.button>
        <x-ui.button mode="ored">OLink</x-ui.button>
        <x-ui.button mode="link">Link</x-ui.button>
        <x-ui.button mode="x">Invalid mode Link</x-ui.button>
    </div>
</x-layout>
