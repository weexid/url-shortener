<nav class="bg-primary-orange">
    <div class="max-w-7xl mx-auto md:flex md:justify-between px-3 py-5 relative">
        <div class="flex justify-between items-center">
            <div class="nav-logo text-white font-bold text-base">
                <a href="{{route('homepage')}}">URL-SHRT</a>
            </div>
                <div class="flex items-center gap-2">
                    @guest
                        <a href="{{route('login')}}" class="md:hidden text-sm font-semibold text-white hover:text-white/[.9]">Login</a>
                    @endguest
                    @auth
                        <a href="#" class="md:hidden text-sm font-semibold text-white hover:text-white/[.9]">{{auth()->user()->name}}</a>
                    @endauth
                    <i id="open-nav" class='md:hidden cursor-pointer bx bx-menu text-white text-[1.8rem]'></i>
                </div>
        </div>


        <div id="menu-mobile" class="hidden md:hidden absolute left-0 w-[100%] bg-primary-orange nav-item font-medium flex flex-col text-center md:flex md:flex-row text-md ">
            {{-- <a href="#" class="text-white hover:text-white/[.9]">Our plans</a> *flex justify-between p-3 --}}
                <a href="{{route('about.page')}}" class="text-white hover:text-white/[.9] p-2">About us</a>
                @guest
                    <a href="{{route('register')}}" class="text-white hover:text-white/[.9] p-2">Register</a>
                @endguest
                
                @auth
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="text-white hover:text-white/[.9] p-2">Logout</a>
                    </form>
                @endauth
                
        </div>

        <div id="menu-desktop" class="hidden sm:hidden nav-item font-medium flex flex-col gap-5 text-center md:flex md:flex-row md:items-center">
            {{-- <a href="#" class="text-white hover:text-white/[.9]">Our plans</a> *flex justify-between p-3 --}}
            <a href="{{route('about.page')}}" class="text-white hover:text-white/[.9]">About us</a>
            @guest
                <a href="{{route('register')}}" class="text-white hover:text-white/[.9]">Register</a>
                <a href="{{route('login')}}" class="text-white hover:text-white/[.9]">Login</a>
            @endguest
            @auth
                <a href="#" class="text-white hover:text-white/[.9]">{{auth()->user()->name}}</a>
                <form method="POST" action="{{ route('logout')}}" >
                        @csrf
                        <button type="submit" class="text-white hover:text-white/[.9]">Logout</button>
                </form>
            @endauth
            
        </div>

    </div>
</nav>

<script>
    // menu toggle
    $('#open-nav').on('click', () => {
        let icon = $('#open-nav');
        if(icon.hasClass('bx-menu')){
            icon.addClass('bx-x').removeClass('bx-menu');
            $('#menu-mobile').removeClass('hidden');
        }else{
            icon.addClass('bx-menu').removeClass('bx-x');
            $('#menu-mobile').addClass('hidden');
        }
    });


    $('#profile').on('click', ()=>{
        
        if($('#dropmenu-profile').hasClass('hidden')) {
            $('#dropmenu-profile').removeClass('hidden');
        }
        else{
            $('#dropmenu-profile').addClass('hidden');
        }
    });
</script>
