<html>
  <head>
      <title>{{ $title ?? 'COM621'}}</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  </head>

  <body class="flex flex-col justify-center h-screen">

    <x-nav>
      <x-nav.item href="{{route('home')}}">Home</x-nav.item> 
      <x-nav.item href="{{route('about')}}">About</x-nav.item>     
      <x-nav.item href="{{route('books.index')}}">Books</x-nav.item> 
   
      <x-nav.drop title="NavDropdown 1">
        <x-nav.drop.item href="{{ route('books.index')}}">Books</x-nav.drop.item>
        <x-nav.drop.item href="#">Dummy 1</x-nav.drop.item>
        <x-nav.drop.item href="#">Dummy 2</x-nav.drop.item>
      </x-nav.drop>

      <x-nav.drop title="Dropdown 2">
        <div>
          <x-nav.drop.item href="{{ route('books.index')}}">Books</x-nav.drop.item>
          <x-nav.drop.item href="{{ route('about')}}">About</x-nav.drop.item>  
        </div>
        <x-nav.drop.item href="{{ route('home')}}">Home</x-nav.drop.item>
      </x-nav.drop>
    </x-nav>

    <!-- Display flash message -->
    <x-base.flash />

    <main class="container mx-auto py-5 px-5 flex-grow overflow-y-scroll">
      {{ $slot }}
    </main>
  
    <footer class="border-t-2 bg-gray-50 border-gray-100 py-2 px-4 text-center">
      Copyright@ {{ date("Y") }}
    </footer>   

  </body>
</html>