
{{-- <div class="mb-4">
    <label for="title" class="block text-gray-700 text-sm font-bold mb-2 uppercase">Title</label>
    <input id="title" name="title" type="text" value="{{ old('title',$book->title) }}" class="border rounded-md w-full py-2.5 text-gray-700 leading-tight focus:ring-blue-500 focus:border-blue-500" >
    @error('title')
        <div class="text-sm text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>  --}}

<div class="mb-4">
    <x-form.label for="title">Title</x-form.label>
    <x-form.input name="title" type="text" value="{{ $book->title }}" /> 
    <x-form.error name="title" />
</div>

<div class="mb-4">
    <x-form.label for="author">Author</x-form.label>
    <x-form.input name="author" type="text" value="{{ $book->author }}" /> 
    <x-form.error name="author" />  
</div> 


<div class="flex flex-row gap-4">  
    <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
    <div class="flex-1 mb-4">
        <x-form.label for="year">Year</x-form.label>
        <x-form.input name="year" type="text" value="{{ $book->year }}" /> 
        <x-form.error name="year" />  
    </div> 

    <div class="flex-1 mb-4">
        <x-form.label for="rating">Rating</x-form.label>
        <x-form.input name="rating" type="number" step="0.1" value="{{ $book->rating }}" /> 
        <x-form.error name="rating" />  
    </div> 
</div> 

<div class="mb-4">
    <x-form.label for="description">Description</x-form.label>
    <x-form.textarea rows="8" name="description" value="{{ $book->description }}" /> 
    <x-form.error name="description" />  
</div> 
