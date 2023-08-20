
<x-form.input-group label="Title" name="title" value="{{ $book->title }}" class=""/>

<x-form.input-group label="Author" name="author" value="{{ $book->author }}" class=""/>

<div class="flex flex-row gap-4">  
    <!-- use flex-1 or w-full to make div take up available space or use grid grid-cols-2 gap-2 or wrapping div -->
    <x-form.input-group label="Year" name="year" value="{{ $book->year }}" class="flex-1 "/>
    <x-form.input-group label="Rating" name="rating" type="number" step="0.1" value="{{ $book->rating }}" class="flex-1 "/>
</div>

<x-form.textarea-group label="Description" name="description" rows="8" value="{{ $book->description }}" class=""/>
