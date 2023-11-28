
<form method="POST" wire:submit="save">
    @csrf
    <div class="p-3  rounded-lg">               
        <x-ui.form.input-group label="Name" name="form.name" wire:model="form.name" class="mb-4"/>
        
        <x-ui.form.input-group label="Rating" name="form.rating" wire:model="form.rating" type="number" step="1"/>
        
        <x-ui.form.textarea-group label="Comment" name="form.comment" wire:model="form.comment" rows="4" class="mb-4"/>
        <!--wire:click.prevent="save"-->
        <x-ui.button class="mt-3">Save</x-ui.button>
        {{-- <x-ui.button variant="link" wire:click.prevent="close">Cancel</x-ui.button> --}}
    </div>
</form>

