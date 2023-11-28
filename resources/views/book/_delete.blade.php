<x-ui.button variant="link" x-data class="flex gap-1"
    x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')">
    <x-ui.svg.trash class="text-red-500"><span>Delete</span></x-ui.svg.trash>
</x-ui.button>

<x-ui.modal name="confirm-book-deletion" focusable>
    <form method="post" action="{{ route('books.destroy',['id'=>$book->id]) }}">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Are you sure you want to delete this book? {{$book->id}}
        </h2>

        <div class="mt-6 flex justify-end">
            <x-ui.link variant="link" x-on:click="$dispatch('close')">Cancel</x-ui.link>
            <x-ui.button variant="red" class="ml-3">Delete</x-ui.button>
        </div>
    </form>
</x-ui.modal>