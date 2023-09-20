@props([ 'name' ])
@error($name)
    <div {{ $attributes->merge(["class" => "text-sm text-red-500"]) }}>{{ $message }}</div>
@enderror       
             