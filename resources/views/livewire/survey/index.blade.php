<x-ui.card>

    <div class="flex justify-between items-center gap-2 mb-4">
        <x-ui.form.input wire:model.live.debounce.100ms="search" name="search" placeholder="search..." />
        <x-ui.button variant="light"  wire:click.prevent="$dispatch('open-modal', 'survey-modal')">
           <span>Create</span>
    </x-ui.button>
    </div>


    {{ $search }}
    <x-ui.table>
        <x-slot:thead class="bg-red-50">
            <x-ui.table.tr>
                <x-ui.table.th>Name</x-ui.table.th>                    
                <x-ui.table.th>Rating</x-ui.table.th>          
                <x-ui.table.th class="text-right">Actions</x-ui.table.th>
            </x-ui.table.tr>
        </x-slot:thead>

        <x-slot:tbody>
            @foreach ($surveys as $s )
                <x-ui.table.tr>
                    <x-ui.table.td>{{$s->name}}</x-ui.table.td>                
                    <x-ui.table.td>{{$s->rating}}</x-ui.table.td>
                    <x-ui.table.td class="text-right flex gap-2 justify-end">
                        <x-ui.button variant="link" wire:click="select({{$s->id}}, 'survey-modal')">Edit</x-ui.button> 
                        <x-ui.button variant="link" wire:click="select({{$s->id}}, 'survey-modal')">Show</x-ui.button> 
                    </x-ui.table.td>
                </x-ui.table.tr>
            @endforeach
        </x-slot:tbody>
    </x-ui.table> 

    <div class="mt-4">
        {{ $surveys->links() }}
    </div>


    <x-ui.modal name="survey-modal" focusable>
        <x-slot:title>
            <h3>Survey</h3>
        </x-slot> 
        <livewire:survey.form />       
    </x-ui.modal>

    {{-- <x-ui.modal name="create-survey-modal" focusable> 
        <x-slot:title>
            <h3>Create Survey</h3>
        </x-slot>
        <livewire:survey.create />       
    </x-ui.modal>

    <x-ui.modal name="update-survey-modal" focusable> 
        <x-slot:title>
            <h3>Update Survey</h3>
        </x-slot> 
        <livewire:survey.update />  
    </x-ui.modal> --}}

    {{-- <x-ui.modal name="show-survey-modal" focusable>
        <x-slot:title>
            <h3>Survey Details</h3>
        </x-slot> 
        <livewire:survey.show />  
    </x-ui.modal> --}}

</x-ui.card>


