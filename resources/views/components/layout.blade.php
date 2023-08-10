<html>
  <head>
      <title>{{ $title ?? 'COM621'}}</title>
      <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="flex flex-col justify-center h-screen">

    <nav class="bg-gray-50 px-4 py-2 flex gap-6 border-b">       
      <a class="text-blue-500 hover:text-blue-900 border-b-2 border-transparent hover:border-black" href="/">Home</a>
      <a class="text-blue-500 hover:text-blue-900 border-b-2 border-transparent hover:border-black" href="/about">About</a>
      <a class="text-blue-500 hover:text-blue-900 border-b-2 border-transparent hover:border-black" href="/book">Books</a>
    </nav>        

    <main class="container mx-auto py-5 px-5 flex-grow overflow-y-scroll">
      {{ $slot }}
    </main>
  
    <footer class="border-t-2 bg-gray-50 border-gray-100 py-2 px-4 text-center">
      Copyright@ {{ date("Y") }}
    </footer>   

  </body>
</html>