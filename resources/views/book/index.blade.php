<x-layout>
    <x-slot:title>Books</x-slot:title>

    <x-ui.breadcrumb class="my-3" :crumbs="[
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
    <x-ui.card>

        <x-slot:title class="flex justify-between items-center">
            <span>Books</span>
            
            @can('create', \App\Models\Book::class)
                <x-ui.link href="{{route('books.create')}}" class="flex gap-1">
                    <x-ui.svg.plus/><span>Create</span>
                </x-ui.link>
            @endcan

        </x-slot:title>
      
       
        <form method="GET" action="{{route('books.index')}}" class="flex gap-2 items-center">
            <x-ui.form.input name="search" value="{{$search}}" class="text-xs" /> 
            <x-ui.button variant="yellow" class="text-xs">Search</x-ui.button>
            <x-ui.link   variant="light" class="text-xs" href="{{route('books.index')}}">Clear</x-ui.link>
        </form>                   
       
        {{-- <table class="min-w-full text-left">
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
                            <a href="{{ route('books.edit',['id' => $book->id])}}"><x-ui.svg.edit/></a>     
                            <a href="{{ route ('books.show',['id' => $book->id]) }}"><x-ui.svg.eye/></a>                            

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  --}}
        
        <x-ui.table>
            <x-slot:thead class="bg-red-50">
                <x-ui.table.tr>
                    <x-ui.table.th>Title</x-ui.table.th>                    
                    <x-ui.table.th>Category</x-ui.table.th>
                    <x-ui.table.th>Year</x-ui.table.th>
                    <x-ui.table.th class="text-right">Actions</x-ui.table.th>
                </x-ui.table.tr>
            </x-slot:thead>
    
            <x-slot:tbody>
                @foreach ($books as $book )
                    <x-ui.table.tr>
                        <x-ui.table.td>{{$book->title}}</x-ui.table.td>
                        <x-ui.table.td>{{$book->category->name}}</x-ui.table.td>                       
                        <x-ui.table.td>{{$book->year}}</x-ui.table.td>
                        <x-ui.table.td class="text-right flex gap-2 justify-end">
                            <a href="{{ route('books.edit',['id' => $book->id])}}"><x-ui.svg.edit/></a>     
                            <a href="{{ route ('books.show',['id' => $book->id]) }}"><x-ui.svg.eye/></a>
                        </x-ui.table.td>
                    </x-ui.table.tr>
                @endforeach
            </x-slot:tbody>
        </x-ui.table> 
        <div class="flex gap-0 text-left text-blue-500 font-bold"></div>
        <x-slot:footer class="flex justify-end">
            {{ $books->links() }}
        </x-slot:footer>
    </x-ui.card>

</x-layout>

