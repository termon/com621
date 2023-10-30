<x-layout>

       
    <x-ui.card>
        <x-slot:title>Register</x-slot:title>
       
        <form  method="POST" action="{{ route('register') }}">
            @csrf

            <x-ui.form.input-group label="Name" name="name" value="{{ old('name', $user->name) }}" class="mb-4" />
          
            <x-ui.form.input-group label="Email" name="email" value="{{ old('email', $user->email) }}" class="mb-4" />
            <x-ui.form.input-group label="Password" name="password" value="{{ old('password', $user->password) }}" type="password" class="mb-4" />

            <div class="flex items-center gap-2 mt-2">
                <x-ui.button mode="dark">Register</x-ui.button>             
                <x-ui.link mode="light" href="/">Cancel</x-ui.link>
            </div>
                
        </form>
    </x-ui.card>
</x-layout>