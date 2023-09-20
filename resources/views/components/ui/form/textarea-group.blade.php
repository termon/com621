@props(['label', 'name', 'value'])
<div {{ $attributes->only('class') }} }}>
    @isset($label)
        <x-ui.form.label name="{{$name}}" class="mb-2">{{$label}}</x-ui.form.label>    
    @endisset
    <x-ui.form.textarea name="{{$name}}" value="{{ $value }}" {{$attributes->except('class')}}/> 
    <x-ui.form.error name="{{$name}}" class="mt-2"/>  
</div>
