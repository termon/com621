{{-- Raw
<div class="mb-4">
    <label for="title" class="block text-gray-700 text-sm font-bold mb-2 uppercase">Title</label>
    <input id="title" name="title" value="{{ old('title',$book->title) }}" class="border rounded-md w-full py-2.5 text-gray-700 leading-tight focus:ring-blue-500 focus:border-blue-500" >
    @error('title')
        <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>  
--}}

{{-- Using components
<div class="mb-4">
    <x-form.label for="title">Title</x-form.label>
    <x-form.input name="title"  value="{{ $book->title }}" /> 
    <x-form.error name="title" />
</div> --}}

{{-- Id required in UpdateFormRequest validation when verifying book title is unique --}}
<input name="id" type="hidden" value={{$book->id}}>

{{-- Using component groups --}}
<x-form.input-group label="Title" name="title" value="{{ $book->title }}" />

<x-form.input-group label="Author" name="author" value="{{ $book->author }}" class=""/>

<div class="flex flex-row gap-4">  
    <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
    <x-form.input-group label="Year" name="year" value="{{ $book->year }}" class="flex-1 "/>
    <x-form.input-group label="Rating" name="rating" type="number" step="0.1" value="{{ $book->rating }}" class="flex-1 "/>
</div>

<x-form.select-group label="Category" name="category_id" :options="$categories" value="{{ $book->category_id }}"/>
    
<x-form.textarea-group label="Description" name="description" rows="8" value="{{ $book->description }}" class=""/>
