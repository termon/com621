@props([
    'name',
    'value' => old($name,$value),
    'options' => []
])
<select id="{{$name}}" name="{{$name}}" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="">Choose option</option>
    @foreach($options as $key => $name ) 
        <option value="{{ $key }}"  {{ $key == old($name,$value) ? 'selected' : ''}}>{{ $name }}</option>
    @endforeach
</select>


