@props(['label', 'name', 'value'])
<div {{ $attributes->merge(["class" => "mb-4"]) }}>
    <x-form.label name="{{$name}}">{{$label}}</x-form.label>
    <x-form.textarea name="{{$name}}" value="{{ $value }}" {{$attributes->except('class')}}/> 
    <x-form.error name="{{$name}}" />  
</div>
