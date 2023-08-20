<html>
  <head>
      <title>{{ $title ?? 'COM621'}}</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  </head>

  <body class="flex flex-col justify-center h-screen">

    <nav class="bg-gray-50 px-4 py-2 flex gap-6 border-b">       
      <a class="text-blue-500 hover:text-blue-900 border-b-2 border-transparent hover:border-black" href="{{ route("home")}}">Home</a>
      <a class="text-blue-500 hover:text-blue-900 border-b-2 border-transparent hover:border-black" href="{{ route("about")}}">About</a>
      <a class="text-blue-500 hover:text-blue-900 border-b-2 border-transparent hover:border-black" href="{{ route("books.index")}}">Books</a>
    </nav>        

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