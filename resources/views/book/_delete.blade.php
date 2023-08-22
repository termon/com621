<x-base.link mode="link" x-data="" class="flex gap-2 items-center"
    x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion')">
  <span>Delete</span><x-svg.trash class=""></x-svg.trash>
</x-base.link>

<x-base.modal name="confirm-book-deletion" focusable>
    <form method="post" action="{{ route('books.destroy',['id'=>$book->id]) }}">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Are you sure you want to delete this book?
        </h2>

        <div class="mt-6 flex justify-end">
            <x-base.link mode="light" x-on:click="$dispatch('close')">Cancel</x-base.link>
            <x-base.button class="ml-3" mode="red">Delete</x-base.button>
        </div>
    </form>
</x-base.modal>