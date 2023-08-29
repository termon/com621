@props(['label', 'name', 'value'])
<div {{ $attributes->merge(["class" => "mb-4"]) }}>
    <x-ui.form.label for="{{$name}}">{{$label}}</x-ui.form.label>
    <x-ui.form.input-file {{$attributes->except('class')}} name="{{$name}}" value="{{ $value }}" /> 
    <x-ui.form.error name="{{$name}}" />  
</div>
