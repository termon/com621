<style>
    .italic {
        font-style: italic;
    }

    .bold {
        font-weight: bold;
    }
</style>

<x-layout>
    <x-slot:title>Practical</x-slot:title>

    <x-ui.breadcrumb class="my-3" :crumbs="[
        'Home' => '/',
        'Practical' => '' 
      ]" 
    />

    <h1 class="text-2xl text-blue-800">Practical</h1>
    <div>
        @if ($question == 1)

        <h1>My Home Page</h1>
        
        <div><span class="bold italic">COM621</span> Full Stack Development</div>

        @elseif ($question == 2)
                @foreach($items as $item)
            <p>{{$item}}</p>
            @endforeach
        @else
            <div>Invalid question...</div>
        @endif
    </div>
    
</x-layout>
