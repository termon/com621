<html>
  <head>
      <title>{{ $title ?? 'COM621'}}</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  </head>

  <body class="flex flex-col justify-center">
  {{-- <body class="flex flex-col justify-center h-screen"> --}}
    <x-ui.nav class="justify-between items-end">
      <div class="flex gap-6">
        <x-ui.nav.item href="{{route('home')}}">Home</x-ui.nav.item> 
        <x-ui.nav.item href="{{route('about')}}">About</x-ui.nav.item>     
        @auth
          <x-ui.nav.item href="{{route('books.index')}}">Books</x-ui.nav.item> 
        
          <x-ui.nav.drop title="NavDropdown 1">
            <x-ui.nav.drop.item href="{{ route('books.index')}}">Books</x-ui.nav.drop.item>
            <x-ui.nav.drop.item href="#">Dummy 1</x-ui.nav.drop.item>
            <x-ui.nav.drop.item href="#">Dummy 2</x-ui.nav.drop.item>
          </x-ui.nav.drop>

          <x-ui.nav.drop title="Dropdown 2">
            <div>
              <x-ui.nav.drop.item href="{{route('books.index')}}">Books</x-ui.nav.drop.item>
              <x-ui.nav.drop.item href="{{route('about')}}">About</x-ui.nav.drop.item>  
            </div>
            <x-ui.nav.drop.item href="{{route('home')}}">Home</x-ui.nav.drop.item>
          </x-ui.nav.drop>
        @endauth
      </div>

      <x-ui.auth.identity />
    </x-ui.nav>

    <!-- Display flash message -->
    <x-ui.flash />

    {{-- <main class="container mx-auto py-5 px-5 flex-grow overflow-y-scroll"> --}}
    <main class="container mx-auto py-5 px-5 flex-grow">
      {{ $slot }}
    </main>
  
    <footer class="border-t-2 bg-gray-50 border-gray-100 py-2 px-4 text-center">
      Copyright@ {{ date("Y") }}
    </footer>   

  </body>
</html>