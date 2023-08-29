<x-layout>
    <x-slot:title>Books</x-slot:title>

    {{-- <x-breadcrumbs :crumbs="['Home'=>route('home'),'Books'=>route('books.index')]" class="my-3"/> --}}

    <x-base.breadcrumb class="my-3" :crumbs="[
            'Home' => route('home'), 
            'Books' => ''
        ]" 
    />
    
    <!-- Flex container for title and create link -->
    {{-- 
    <div class="flex justify-between items-end border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Books</h1>
        <a href="{{ route('books.create')}}" class="hover:text-blue-900 hover:underline text-blue-700">Create</a>
    </div> 
    --}}

    <!-- list of books -->
    <x-base.card>

        <x-slot:title class="flex justify-between items-center">
            <span>Books</span>
            
            <x-base.link href="{{route('books.create')}}" class="flex gap-1">
                <x-svg.plus/><span>Create</span>
            </x-base.link>
        </x-slot:title>
      
       
        <form method="GET" action="{{route('books.index')}}" class="flex gap-2 items-center">
            <x-form.input name="search" value="{{$search}}" class="text-xs" />          
            <x-base.button mode="yellow" class="text-xs">Search</x-base.button>
            <x-base.link   mode="light" class="text-xs" href="{{route('books.index')}}">Clear</x-base.link>
        </form>                   
       
        <table class="min-w-full text-left">
            <thead>
                <tr class="border-b border-gray-300 uppercase text-sm">
                    <th class="px-2 py-3">Title</th>                   
                    <th class="px-2 py-3">Year</th>
                    <th class="px-2 py-3">Category</th>
                    <th class="px-2 py-3 text-right">Actions</th>
                </tr>
            </thead>
    
            <tbody class="divide-y">
                @foreach ($books as $book )
                    <tr hx-get="{{route('books.show',['id'=>$book->id])}}" hx-select="#book">
                        <td class="px-2 py-3">{{$book->title}}</td>
                        <td class="px-2 py-3">{{$book->year}}</td>
                        <td class="px-2 py-3">{{$book->category->name}}</td>
                        <td class="px-2 py-3 text-right flex gap-2 justify-end">
                            <a href="{{ route('books.edit',['id' => $book->id])}}"><x-svg.edit/></a>     
                            <a href="{{ route ('books.show',['id' => $book->id]) }}"><x-svg.eye/></a>                            

                            {{-- <a href="{{ route('books.edit',['id' => $book->id])}}"  class="hover:text-blue-900 hover:underline text-blue-700"> Edit </a> --}}                             
                            {{-- <a href="{{ route ('books.show',['id' => $book->id]) }}" class="hover:text-blue-900 hover:underline text-blue-700 mr-2">View</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
        
        {{-- <x-table>
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
                            <x-link href="/books/{{$book->id}}" mode="light" class="text-xs mr-2">View</x-link>
                            <x-link href="/books/{{$book->id}}/edit" mode="light"  class="text-xs">Edit</x-link>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </x-slot:tbody>
        </x-table> --}}
        
        <x-slot:footer class="flex justify-end">
            {{ $books->links() }}
        </x-slot:footer>
    </x-base.card>

</x-layout>

