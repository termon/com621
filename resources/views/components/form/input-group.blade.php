@props(['label', 'name', 'value' ])
<div {{ $attributes->merge(['class' => 'mb-4'])->only('class') }}>
    <x-form.label for="{{ $name }}">
        {{$label}}
    </x-form.label>
    
    <x-form.input {{ $attributes->merge(['type' => 'text'])->except('class') }} name="{{$name}}" value="{{ $value }}" /> 
    <x-form.error name="{{$name}}" />  
</div>
