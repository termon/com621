<x-layout>

    {{-- <div class="flex justify-between items-center border-b border-gray-700 pb-1 mb-3">
        <h1 class="text-3xl text-blue-900">Login</h1>       
    </div>
        --}}
        
    <x-ui.card>
        <x-slot:title>Login</x-slot:title>

        <form  method="POST" action="{{ route('login') }}">
            @csrf

            <x-ui.form.input-group label="Email" name="email" value="{{ old('email', $user->email) }}" class="mb-4" />
            <x-ui.form.input-group label="Password" name="password" value="{{ old('password', $user->password) }}" type="password" class="mb-4" />

            <div class="flex items-center gap-2 mt-2">
                <x-ui.button mode="dark">Login</x-ui.button>             
                <x-ui.link mode="light" href="/">Cancel</x-ui.link>
            </div>
                
        </form>
    </x-ui.card>
</x-layout>