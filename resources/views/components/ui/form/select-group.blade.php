{{-- @props([
    'label' => null, 
    'name', 
    'value', 
    'options' => []
])
<div {{ $attributes->merge(["class" => "mb-4"])->only('class') }}>
    @isset($label)
        <x-ui.form.label for="{{$name}}">{{$label}}</x-ui.form.label>    
    @endisset
    <x-ui.form.select {{$attributes->except('class')}} name="{{$name}}" value="{{ $value }}" :options="$options" /> 
    <x-ui.form.error name="{{$name}}" />  
</div> --}}

<div {{ $attributes->only('class') }}>
    @isset($attributes['label'])
        <x-ui.form.label for="{{$attributes['name']}}" class="mb-2">{{$attributes['label']}}</x-ui.form.label>    
    @endisset
    <x-ui.form.select {{$attributes->except(['class','options', 'label'])}}  :options="$attributes['options']" /> 
    <x-ui.form.error name="{{$attributes['name']}}" class="mt-2" />  
</div>
