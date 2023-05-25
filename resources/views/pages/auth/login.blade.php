<x-app-layout>
    @section('title', 'Login')

    @section('main')
    {{-- @php
        $error = [
            'email' => 'something went wrong something went wrong',
            // 'password' => 'pw something wrong'
        ];
    @endphp --}}

    
    <div class="flex justify-center">
        <div class="border rounded-md shadow-xl w-full p-5 mt-20">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="mb-3 max-w-[300px]">
                    <label class="text-md text-slate-700" for="email">{{__('Email')}}</label> <br>
                    <input class="w-full rounded-md border-slate-200 border-2" type="email" name="email" id="email" value="{{old('email')}}" autocomplete="off">
                    <br>
                    <x-input-error :messages="$errors->get('email')"/>
                </div>
                <div class="mb-3 max-w-[300px">
                    <label class="text-md text-slate-700" for="password">{{__('Password')}}</label> <br>
                    <div class="flex items-center">
                        <div class="relative flex items-center">
                            <input class="w-full rounded-md border-slate-200 border-2 " type="password" name="password" id="password" value="{{old('password')}}" autocomplete="off" />
                            <div class="absolute right-2 z-20 bg-white px-1 cursor-pointer">
                                <i id="show-password" class='bx bx-show text-xl text-gray-600'></i>
                            </div>
                        </div>
                    </div>
                    
                    <x-input-error :messages="$errors->get('password')"/>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded  border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                </div>
                <div class="w-100 mt-5">
                    <x-primary-button>
                        {{__('Login')}}
                    </x-primary-button>
                </div>
                <div class="mt-5 max-w-[250px] text-sm text-center flex items-center justify-between">
                    <div>
                        <span class="text-gray-800"><a href="{{route('password.request')}}">{{__('Forgot Password?')}}</a></span>
                    </div>
                    <div class="">
                        <span class="text-primary-orange"><a href="{{route('register')}}">
                        {{__('Register')}}
                        </a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
        <script>
            
            $('#show-password').on('click', () => {
                btn_show = $('#show-password');
                var pw_input = $('#password');
                var field_type = pw_input.attr('type');
                if(field_type === 'password'){
                    pw_input.attr('type', 'text');
                    btn_show.removeClass('bx-show');
                    btn_show.addClass('bx-hide');
                }else{
                    pw_input.attr('type', 'password');
                    btn_show.removeClass('bx-hide');
                    btn_show.addClass('bx-show');
                }
            })
        </script>
    @endsection
</x-app-layout>