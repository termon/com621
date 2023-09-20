@props([
    'label' => null, 
    'name', 
    'value']
)
<div {{ $attributes->only('class') }} }}>
    @isset($label)
        <x-ui.form.label for="{{$name}}" class="mb-2">{{$label}}</x-ui.form.label>    
    @endisset
    <x-ui.form.input-file {{$attributes->except('class')}} name="{{$name}}" value="{{ $value }}" /> 
    <x-ui.form.error name="{{$name}}" class="mt-2"/>  
</div>
