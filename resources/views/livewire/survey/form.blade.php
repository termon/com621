<form >
    @csrf
    <div class="p-3  rounded-lg">               
        <x-ui.form.input-group label="Name" name="form.name" wire:model="form.name" class="mb-4"/>
        
        <x-ui.form.input-group label="Rating" name="form.rating" wire:model="form.rating" type="number" step="1"/>
        
        <x-ui.form.textarea-group label="Comment" name="form.comment" wire:model="form.comment" rows="4" class="mb-4"/>
        
        <x-ui.button  wire:click.prevent="save" class="mt-3">Save</x-ui.button>
        <x-ui.button variant="light" wire:click.prevent="cancel" class="mt-3">Cancel</x-ui.button>
    </div>
</form>
