@props([
    'label', 
    'name', 
    'value' => '', 
    'options' => []
])
<div {{ $attributes->merge(["class" => "mb-4"]) }}>
    <x-form.label for="{{$name}}">{{$label}}</x-form.label>
    <x-form.select {{$attributes->except('class')}} name="{{$name}}" value="{{ $value }}" :options="$options" /> 
    <x-form.error name="{{$name}}" />  
</div>
