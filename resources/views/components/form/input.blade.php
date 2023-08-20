@props([
 'name',
 'value'
])
@php
$border = $errors->has($name) ?  "border border-red-200" : "";
@endphp
<input id={{$name}} name={{$name}} value="{{ old($name,$value) }}" {{ $attributes->merge(["class" => "border rounded-md w-full p-2.5 text-gray-700 leading-tight focus:ring-blue-500 focus:border-blue-500 " . $border]) }}>

            
             
             