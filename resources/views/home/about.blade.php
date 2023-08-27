
<x-layout>
    <x-slot:title>About</x-slot:title>
    <x-base.breadcrumb class="my-3" :crumbs="[
        'Home' => route('home'), 
        'About' => ''
      ]" 
    />
    
    <div class="mt-4">
        <h2>About Us</h2>
    </div>
    
</x-layout>  