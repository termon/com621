@auth
    <form method="post" action="{{ route('logout') }}" class="flex gap-2 items-center">
        @csrf
        <x-ui.button type="submit" mode="none" class="text-gray-700 hover:text-gray-900">Logout</x-ui.button>
        <div class="text-sm text-gray-400">({{ auth()?->user()?->email }} - {{ auth()?->user()?->role}})</div> 
    </form>
@endauth 
@guest
<div class="flex gap-2 items-center"> 
    <x-ui.nav.item href="{{route('login')}}">Login</x-ui.nav.item>
    <x-ui.nav.item href="{{route('register')}}">Register</x-ui.nav.item>
</div>
@endguest 


