<x-layout>
    <x-slot:title>Books</x-slot:title>

    <!-- Flex container for title and create link -->
    <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Books</h1>
      
        <x-button href="/books/create" class="text-xs"> 
            Create
        </x-button> 

     
    </div>

    <!-- list of books -->
    <div class="mt-2">
       
        <x-table>
            <x-slot:thead class="bg-red-50">
                <x-table.tr>
                    <x-table.th>Title</x-table.th>
                    <x-table.th>Author</x-table.th>
                    <x-table.th>Year</x-table.th>
                    <x-table.th class="text-right">Actions</x-table.th>
                </x-table.tr>
            </x-slot:thead>
    
            <x-slot:tbody>
                @foreach ($books as $book )
                    <x-table.tr>
                        <x-table.td>{{$book->title}}</x-table.td>
                        <x-table.td>{{$book->author}}</x-table.td>
                        <x-table.td>{{$book->year}}</x-table.td>
                        <x-table.td class="text-right">
                            <x-link href="/books/{{$book->id}}" type="light" class="text-xs mr-2">View</x-link>
                            <x-link href="/books/{{$book->id}}/edit" type="light"  class="text-xs">Edit</x-link>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-slot:tbody>
        </x-table>

    </div>


</x-layout>

