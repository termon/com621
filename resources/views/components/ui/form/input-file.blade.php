@props([
  'label',      
  'name',
  'type' => 'light'
])

@php
$base = "bg-white block w-full text-sm rounded-lg border border-gray-300 cursor-pointer focus:outline-none file:mr-2 file:py-2 file:px-3 file:rounded-l-md file:border-0 file:text-sm file:font-semibold hover:file:cursor-pointer hover:file:opacity-80";
$classes = match ($type) {
    'light'  => "$base file:bg-gray-100   file:text-gray-900",
    'blue'   => "$base file:bg-blue-700   file:text-white",
    'gray'   => "$base file:bg-gray-500   file:text-white",
    'dark'   => "$base file:bg-gray-900   file:text-white",
    'green'  => "$base file:bg-green-500  file:text-white",
    'red'    => "$base file:bg-red-500    file:text-white",
    'yellow' => "$base file:bg-yellow-400 file:text-white",
    'purple' => "$base file:bg-purple-700 file:text-white",
    default => throw new \Exception("No such input file type: $type" ),
};
$classes = $errors->has($name) ?  "$classes border border-red-200" : $classes;
@endphp

<input id={{$name}} name={{$name}} type="file" {{ $attributes->merge(['class' => $classes])}}>