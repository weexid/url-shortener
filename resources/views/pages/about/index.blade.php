<x-app-layout>
    @section('title', 'About')

    @section('main')
        <div class="text-center w-[100%]">
            <div class="py-[100px] w-[100%] bg-gradient-to-r from-primary-orange to-secondary-light_orange">
                <h1 class="font-bold text-4xl text-white drop-shadow-md">About Page</h1>
            </div>
            <div class="px-1">
                <div class="md:flex items-center text-center">
                    <div class="w-[100%]">
                        <img src="/assets/how-it-works.jpg" alt="how-it-works">
                    </div>
                    <div class="">
                        <h2 class="md:pt-5 pb-3 text-xl font-bold">What is URL-SHRT</h2>
                        <p class="text-justify p-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, nesciunt sed! Laborum doloremque veritatis, obcaecati rem asperiores eum voluptatibus laudantium, sed nostrum vero, alias deserunt ex hic. Ipsam numquam repellat in sapiente.</p>
                    </div>
                </div>
                <div class="my-5">
                    <h2 class="font-bold text-xl pb-3">Connect with me on</h2>
                    <div class="flex justify-center items-center text-3xl gap-5">
                        <a href="http://github.com" class="hover:text-primary-orange" target="_blank" rel="noopener noreferrer">
                            <i class='bx bxl-github'></i>
                        </a>
                        <a href="http://twitter.com" class="hover:text-primary-orange" target="_blank" rel="noopener noreferrer">
                            <i class='bx bxl-twitter' ></i>
                        </a>
                        <a href="http://instagram.com" class="hover:text-primary-orange" target="_blank" rel="noopener noreferrer">
                            <i class='bx bxl-instagram-alt' ></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>