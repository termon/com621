<html>
  <head>
      <title>{{ $title ?? 'COM621'}}</title>
      <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>
 
    <nav class="bg-gray-100 p-4 flex gap-4"> 
      <a href="/"      class="text-blue-500 hover:text-blue-900 hover:underline" >Home</a>
      <a href="/about" class="text-blue-500 hover:text-blue-900 hover:underline">About</a>
      <a href="/books" class="text-blue-500 hover:text-blue-900 hover:underline">Books</a>
     </nav> 
     
     <main class="px-3 py-3">
        {{ $slot }}
    </main>

    <footer class="px-3">
      Copyright@ {{ date("Y") }}
    </footer> 
   

  </body>
</html>