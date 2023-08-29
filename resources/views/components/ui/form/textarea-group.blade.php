@props(['label', 'name', 'value'])
<div {{ $attributes->merge(["class" => "mb-4"]) }}>
    <x-ui.form.label name="{{$name}}">{{$label}}</x-ui.form.label>
    <x-ui.form.textarea name="{{$name}}" value="{{ $value }}" {{$attributes->except('class')}}/> 
    <x-ui.form.error name="{{$name}}" />  
</div>
