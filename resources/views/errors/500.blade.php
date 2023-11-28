<x-layout-guest>
    <x-slot:title>500 Error</x-slot:title>

    <section class="w-full px-16 md:px-0 h-screen flex items-center justify-center">
        <div class="bg-gray-50 border border-gray-200 flex flex-col items-center justify-center px-4 md:px-8 lg:px-24 py-8 rounded-lg shadow-2xl">
            <p class="text-6xl md:text-7xl lg:text-9xl font-bold tracking-wider text-gray-300">500</p>
            <p class="text-2xl md:text-3xl lg:text-5xl font-bold tracking-wider text-gray-500 mt-4">Oops!!!</p>
            <p class="text-gray-500 mt-4 pb-4 border-b-2 text-center">Sorry, something went wrong and we could not process this request.</p>
            <a href="{{route('home')}}" class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 mt-6 rounded transition duration-150" title="Return Home">
                <x-ui.svg.home/>              
            </a>
        </div>
    </section>
    
</x-layout-guest>