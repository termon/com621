<x-ui.link x-data="" class="flex gap-2"
    x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')">
  <span>Delete</span><x-ui.svg.trash class=""></x-ui.svg.trash>
</x-ui.link>

<x-ui.modal name="confirm-book-deletion" focusable>
    <form method="post" action="{{ route('books.destroy',['id'=>$book->id]) }}">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Are you sure you want to delete this book?
        </h2>

        <div class="mt-6 flex justify-end">
            <x-ui.link mode="light" x-on:click="$dispatch('close')">Cancel</x-ui.link>
            <x-ui.button class="ml-3" mode="red">Delete</x-ui.button>
        </div>
    </form>
</x-ui.modal>