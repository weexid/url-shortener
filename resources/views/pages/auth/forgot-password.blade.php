<x-app-layout>
    @section('title', 'Forgot Password')

    @section('main')

    <div class="flex justify-center">  
        <div class="border rounded-md shadow-xl max-w-[375px] p-5 mt-20 m-2">
            <div class="mb-4 text-sm text-gray-500">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>


            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- form email --}}
            <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-auth.label-form for="email" :value="__('Email')"/>
                <x-auth.input-field type="email" id="email" name="email" />

                {{-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus /> --}}

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Send Reset Link') }}
                </x-primary-button>
            </div>
        </form>
        </div>
    </div>

    
        
    @endsection
</x-app-layout>