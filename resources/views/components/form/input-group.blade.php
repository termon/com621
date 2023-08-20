@props(['label', 'name', 'value'])
<div {{ $attributes->merge(["class" => "mb-4"]) }}>
    <x-form.label for="{{ $name }}">
        {{$label}}
    </x-form.label>
    
    <x-form.input {{$attributes->except('class')}} name="{{$name}}" type="text" value="{{ $value }}" /> 
    <x-form.error name="{{$name}}" />  
</div>
