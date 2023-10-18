<html>
  <head>
      <title>{{ $title ?? 'COM621'}}</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
  </head>

  <body class="flex flex-col justify-center h-screen">

    <!-- Display flash message -->
    <x-ui.flash />

    <main class="container mx-auto py-5 px-5 flex-grow overflow-y-scroll">
      {{ $slot }}
    </main>
  
    <footer class="border-t-2 bg-gray-50 border-gray-100 py-2 px-4 text-center">
      Copyright@ {{ date("Y") }}
    </footer>   

  </body>
</html>