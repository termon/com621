@props(['label', 'name', 'value' ])
<div {{ $attributes->merge(['class' => 'mb-4'])->only('class') }}>
    <x-ui.form.label for="{{ $name }}">
        {{$label}}
    </x-ui.form.label>
    
    <x-ui.form.input {{ $attributes->merge(['type' => 'text'])->except('class') }} name="{{$name}}" value="{{ $value }}" /> 
    <x-ui.form.error name="{{$name}}" />  
</div>
