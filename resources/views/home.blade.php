
<x-app-layout titile="URL-SRTV">
    @section('main')
        <div id="alert-success" class="hidden absolute bg-green-300 py-2 px-5 top-10 right-2 rounded text-md font-semibold z-100">Helo</div>

    <div class="container w-[100%] flex items-center flex-col">
        <div class="mt-5 border rounded-xl p-5 max-w-[350px] mx-2 flex justify-center bg-white shadow-xl">
            <div class="w-[100%] text-center">
                <label class="text-primary-orange font-bold inline-block mb-5 text-[24px]" for="original_url">Short your URL</label>
                <form method="POST" action="{{route('short.url')}}">
                    @csrf
                    <input name="original_url" id="original_url" type="text" class="rounded-[12px] border-2 border-primary-orange focus:ring-0 focus:border-orange-700 placeholder:text-secondary-light_orange placeholder:font-bold px-5" placeholder="https://web.telegram.org/" value="{{old('original_url')}}">
                    @error('original_url')
                        <br>
                        <span class="text-red-400 font-bold m-2 text-[12px]"> {{$message}} </span>
                    @enderror
                    <button type="submit" class="bg-primary-orange px-5 py-2 mt-5 rounded-[30px] text-white font-bold">Generate Short Url</button>
                </form>
                @if (session('shorted_link'))
                    <div class="mt-5 max-w-[250px] mx-auto scrollbar-hide overflow-x-scroll">
                    <p class="inline-block bg-secondary-light_orange p-2 mb-2" id="short-link">
                        <a id="generated-link" href="{{session('shorted_link')}}">{{session('shorted_link')}}</a>
                    </p>
                    </div>
                    <p class="cursor-pointer inline font-semibold text-secondary-dark_brown transititext-primary transition duration-150 ease-in-out" id="copy-generated-link" onclick="copyTextToClipboard('#generated-link')" data-te-toggle="tooltip" title="Copy to clipboard">Copy link</p>
                @endif
                
                @guest
                    <p class="font-semibold text-secondary-dark_brown mt-3">Please <span class="text-secondary-light_orange"><a href="{{route('login')}}">Login</a></span> for edit your links</p>
                @endguest
            </div>
            {{-- <button id="open-edit-modal">open edit</button> --}}
        </div>

        @auth
        @if (count($links) > 0)
            <div class="mt-5 border rounded-xl p-5 w-[100%] max-w-[350px] mx-2 flex justify-center bg-white shadow-xl">
                <div class="bg-white overflow-x-scroll ">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-primary-orange">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Original link
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Short sufix
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Visited
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    detail
                                </th>
                            </tr>
                        </thead>
                        <tbody class="overflow-x-scroll">
                            @foreach ($links as $index => $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 text-center">{{$index+1}}</td>
                                <td class="px-6 py-4 truncate max-w-[150px]">
                                    <a href="{{$item->original_url}}"
                                        target="_blank"
                                        data-te-toggle="tooltip"
                                        title="{{$item->original_url}}">
                                        {{$item->original_url}}
                                    </a>
                                </td>
                                <td class="px-6 py-4 truncate">
                                    <a target="_blank" data-te-toggle="tooltip" title="{{url('/'. $item->short_url)}}" href="{{url('/' . $item->short_url)}}">/{{$item->short_url}}</a>
                                <td class="px-6 py-4 text-center">
                                    {{$item->visitor_count}}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button class="bg-primary-orange hover:bg-orange-500 text-white font-bold py-2 px-4 rounded" id="open" data-visitor-link="{{route('show.visitor', ['id_link' => $item->id])}}" onclick="showModal({{$item->id}})">Detail</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
        @endif
            
        @endauth
        
        {{-- modal--}}
        <div id="modalOverlay" class="z-50" style="display:none;">
            <div id="Overlay" class="z-70 fixed inset-0 opacity-40 bg-black"></div>
            
            <div id="modal" class="rounded-2xl max-w-2xl fixed w-[90%] top-[55%] left-[50%] text-center bg-secondary-bg_modal box-border opacity-0 translate-x-[-50%] translate-y-[-50%] ease-in-out duration-300">
                    <div class="flex py-2 w-full items-center justify-center border-b">
                        <h1 class="pt-4 text-xl text-black font-semibold text-center pb-4">Detail link</h1>
                        <button id="close" class="m-4 absolute top-0 right-1 hover:bg-gray-200 rounded-full p-1 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:ring-black" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="px-5 py-3" >
                        <div class="text-left mb-3 flex justify-start gap-5 items-center">
                            <p id="link" class="text-sm font-bold">Short: <span class="font-semibold"><a target="_blank" href="#" id="short_url" class="text-primary-orange"></a></span></p>
                            <span onclick="copyToClipboard('#short_url')" id="copy-link" class="cursor-pointer text-[12px] px-3 bg-slate-200 text-slate-600 hover:text-slate-800 hover:bg-secondary-light_orange">copy link</span>
                            
                        </div>
                        <div class="text-left mb-3">
                            <p class="text-sm font-bold">Long Url:</p>
                            <p id="org_url" class="text-sm font-semibold break-all"></p>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold">Total Clicked: <span class="font-semibold"><a href="#" id="visited" target="_blank" class="text-primary-orange"></a></span></p>
                        </div>
                        <div class="mt-[3rem] justify-end flex gap-3">
                            <button id='delete-btn' class="rounded-md py-1 px-5 bg-red-500 text-white" onclick="deleteShort()">Delete</button>
                            <button id="open-edit-modal" class="rounded-md py-1 px-5 bg-orange-500 text-white">edit</button>
                        </div>
                    </div>
            </div>

            {{-- <div id="Overlay" class="opacity-25 fixed inset-0 z-40 bg-black"></div> --}}
        </div>

        {{-- edit modal --}}
        @include('pages.short.edit')

    {{-- jquery --}}
    <script>
        $(document).ready(function() { 
            $('#copy').on('click', function() {
                var textToCopy = $('#short-link').text();
                
                var tempInput = $('<input>');

                tempInput.val(textToCopy);

                $('body').append(tempInput);

                tempInput.select();

                document.execCommand('copy');

                tempInput.remove();

                alert('Short link copied to clipboard ' + textToCopy);

            });
        });

        function copyTextToClipboard(ele){
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(ele).text()).select();
            document.execCommand("copy");
            $temp.remove();
            $('#copy-generated-link').html('copied')
            setTimeout(() => {
                $('#copy-generated-link').html('Copy link')
            }, 2000);
        }

        function copyToClipboard(ele) {
            if(link)
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(ele).attr("href")).select();
                document.execCommand("copy");
                $temp.remove();
                $('#copy-link').html('Copied');
            
                setTimeout(() => {
                    $('#copy-link').html('Copy link');
                }, 2000);
        }
        
        function deleteShort(){
            let id = $('#delete-btn').data('id');

            $.ajax({
                
                url: '/delete/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert-success').show();
                    $('#alert-success').html(response.message);
                    setTimeout(function () {
                        $('#alert-success').hide();
                        location.reload();
                    }, 2000)
                }
            });

        };

        function showModal(id) {
            // console.log(window.location.origin);
            let originLocation = window.location.origin;
            let visitor_detail_link = $('#open').data('visitor-link');
            // let visitor_route = visitor_detail_link.val();



            $.ajax({
                url: '/short-url/' + id,
                success: function(response) {
                    $('#short_url').text(response.short_url);
                    $('a#short_url').attr('href', `${originLocation}/${response.short_url}`);
                    $('#org_url').text(response.original_url);
                    $('a#visited').attr('href', `visitor/${id}`);
                    $('#visited').text(response.visits);
                    $('#modalOverlay').show().addClass('modal-open');
                    // $('#open-edit-modal').attr('data-short', id);
                    $('#open-edit-modal').data('short', response.short_url);
                    $('#open-edit-modal').data('id', id);
                    $('#delete-btn').data('id', id);
                }
            });
        }

        $(document).ready(function(){
            $('#close').click(function() {
                var modal = $('#modalOverlay');
                modal.removeClass('modal-open');
                setTimeout(function() {
                    modal.hide();
                },200);
            });

            $('#Overlay').click(function() {
                var modal = $('#modalOverlay');
                modal.removeClass('modal-open');
                setTimeout(() => {
                    modal.hide();
                }, 200);
            });
        })

    </script>
@endsection
</x-app-layout>