@props([
 'name',
 'value'
])

<textarea id={{$name}} name={{$name}} {{ $attributes->merge(["class" => "border rounded-md w-full p-2.5 text-gray-700 leading-tight focus:ring-blue-500 focus:border-blue-500" ]) }}>{{ old($name,$value) }}</textarea>

             
             