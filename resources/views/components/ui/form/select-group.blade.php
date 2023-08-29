@props([
    'label', 
    'name', 
    'value' => '', 
    'options' => []
])
<div {{ $attributes->merge(["class" => "mb-4"]) }}>
    <x-ui.form.label for="{{$name}}">{{$label}}</x-ui.form.label>
    <x-ui.form.select {{$attributes->except('class')}} name="{{$name}}" value="{{ $value }}" :options="$options" /> 
    <x-ui.form.error name="{{$name}}" />  
</div>
