<div>
    <x-ui.display title="Name" value={{$survey?->name}} />
    <x-ui.display title="Rating" value={{$survey?->rating}} />
    <x-ui.display title="Comment" value={{$survey?->comment}} />

        <div>
            <x-ui.button variant="red" 
                         type="button"
                         wire:click="delete"
                         wire:confirm="Are you sure you want to delete this survey?"
            >Delete</x-ui.button>
            <x-ui.button variant="link"
                        type="button"
                        wire:click="close"
            >Cancel</x-ui.button>
        </div>
</div>
