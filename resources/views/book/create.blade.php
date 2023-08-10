<x-layout>

    <form  method="POST" action="/books">
        @csrf
        <div class="flex-1">
           
            <div class='flex flex-col gap-x-2 gap-y-2 my-2'>
                <label for="title" class="block font-bold text-sm text-gray-700 uppercase dark:text-gray-100">Title</label>
                <div class="flex flex-col gap-y-2 w-full">
                    <input id="title" name="title" type="text" value="{{$book->title}}" class="form-input w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error("title")
                        <div class="text-sm text-red-500 dark:text-red-800">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class='flex flex-col gap-x-2 gap-y-2 my-2'>
                <label for="title" class="block font-bold text-sm text-gray-700 uppercase dark:text-gray-100">Title</label>
                <div class="flex flex-col gap-y-2 w-full">
                    <input id="title" name="title" type="text" value="{{$book->title}}" class="form-input w-full  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error("title")
                        <div class="text-sm text-red-500 dark:text-red-800">{{$message}}</div>
                    @enderror
                </div>
            </div>
            
            <div class="my-2 flex gap-2">
                <button  type="submit">Create</button>
                <a href="/books">Cancel</a>
            </div>
        </div>
    </form>

</x-layout>
