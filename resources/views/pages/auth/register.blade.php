<x-app-layout>
    @section('title', 'Register')

    @section('main')
        {{-- @php
            $simulationError = [
                'username' => 'Error........ your username error, Error........ your username error'
            ]
        @endphp --}}
        <div class="flex justify-center">
            <div class="border rounded-md shadow-xl w-full p-5 mt-20">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{-- Name --}}
                    <div class="mb-3 max-w-[300px]">
                        <x-auth.label-form for="name">
                            {{__('Name')}}
                        </x-auth.label-form>
                        <x-auth.input-field type="text" name="name" id="name" :value="old('name')" />
                        <x-input-error class="ml-1" :messages="$errors->get('name')" />
                    </div>

                    {{-- Email Address --}}
                    <div class="mb-3 max-w-[300px]">
                        <x-auth.label-form for="email">
                            {{__('Email')}}
                        </x-auth.label-form>
                        <x-auth.input-field type="email" name="email" id="email" :value="old('email')"/>
                        <x-input-error class="ml-1" :messages="$errors->get('email')"/>
                    </div>

                    {{-- Password --}}
                    <div class="mb-3 max-w-[300px]">
                        <x-auth.label-form for="password">
                            {{__('Password')}}
                        </x-auth.label-form>
                        <x-auth.input-field type="password" name="password" id="password" />
                        <x-input-error class="ml-1" :messages="$errors->get('password')"/>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3 max-w-[300px]">
                        <x-auth.label-form for="password_confirmation">
                            {{__('Confirm Password')}}
                        </x-auth.label-form>
                        <x-auth.input-field type="password" name="password_confirmation" id="password_confirmation" />
                        <x-input-error class="ml-1" :messages="$errors->get('password_confirmation')"></x-input-error>
                    </div>
                    
                    <div class="mb-3 text-center">
                        <x-primary-button>
                        {{__('Register')}}
                        </x-primary-button>
                        <div class="mt-3 text-sm">
                            {{__('Already have account?')}}
                            <span class="text-primary-orange"><a href="{{route('login')}}">{{__('login')}}</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-app-layout>