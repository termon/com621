<div class="flex gap-2">
    <x-ui.button variant="green" wire:click="increment">+</x-ui.button>
    <span class="text-2xl text-blue-900">{{$counter}}</span>
    <x-ui.button variant="red" wire:click="decrement">-</x-ui.button>
</div>
