<x-ui.card>

    <x-slot:title class="flex justify-between items-center">
        <span>Books</span>       

    </x-slot:title>
  
    <div class="flex justify-between items-center gap-2 mb-4">
        <x-ui.form.input wire:model.live.debounce.100ms="query" name="query" placeholder="search..." />
        <x-ui.link   variant="light" class="text-xs" >Clear</x-ui.link>
    </div>                   
       
    <x-ui.table>
        <x-slot:thead class="bg-red-50">
            <x-ui.table.tr>
                <x-ui.table.th>Title</x-ui.table.th>                    
                <x-ui.table.th>Category</x-ui.table.th>
                <x-ui.table.th>Year</x-ui.table.th>               
            </x-ui.table.tr>
        </x-slot:thead>

        <x-slot:tbody>
            @foreach ($books as $book )
                <x-ui.table.tr>
                    <x-ui.table.td>{{$book->title}}</x-ui.table.td>
                    <x-ui.table.td>{{$book->category->name}}</x-ui.table.td>                       
                    <x-ui.table.td>{{$book->year}}</x-ui.table.td>
                </x-ui.table.tr>
            @endforeach
        </x-slot:tbody>
    </x-ui.table> 
    <div class="flex gap-0 text-left text-blue-500 font-bold"></div>
    <x-slot:footer class="flex justify-end">
        {{ $books->links() }} 
    </x-slot:footer>
</x-ui.card>

