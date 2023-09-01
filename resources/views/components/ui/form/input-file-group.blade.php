@props([
    'label' => null, 
    'name', 
    'value']
)
<div {{ $attributes->merge(["class" => "mb-4"])->only('class') }} }}>
    @isset($label)
        <x-ui.form.label for="{{$name}}">{{$label}}</x-ui.form.label>    
    @endisset
    <x-ui.form.input-file {{$attributes->except('class')}} name="{{$name}}" value="{{ $value }}" /> 
    <x-ui.form.error name="{{$name}}" />  
</div>
