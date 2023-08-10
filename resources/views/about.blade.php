@php
    $rows = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
@endphp
<x-layout>
    <x-slot:title>About</x-slot:title>
    @foreach($rows as $row)    
    <h1 class="my-2">About Page {{$loop->index+1}}</h1> 
    @endforeach
</x-layout>  