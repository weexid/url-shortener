<x-app-layout>
    @section('title', 'Detail Visitor')

    @section('main')
        <div class="p-3 text-center">
            <h1 class="text-2xl font-bold">Visitor Details</h1>
            <div class="text-sm mt-[-5px] text-slate-700">Short Link :
                <span class="text-primary-orange">
                    <a href="#" target="_blank" rel="noopener noreferrer">
                        {{$link->short_url ?? '/short-links'}}
                    </a> 
                </span>
            </div>
            @if (count($location) > 0)
            <table class="min-w-[300px] w-[100%] mt-5">
                <thead class="border bg-slate-200">
                    <tr>
                        <th class="border p-2">#</th>
                        <th class="border p-2">Country</th>
                        <th class="border p-2">Total</th>
                    </tr>
                </thead>
                <tbody class="border">
                    
                    @foreach ($location as $index => $item)
                    <tr>
                        <td class="p-2">{{$index+1}}</td>
                        {{-- validasi localhost --}}
                        @if ($item->country == null)
                            <td class="p-2">Localhost</td>
                        @else
                            <td class="p-2">{{$item->country}}</td>
                        @endif
                        <td class="p-2">{{$item->count}}</td>
                    </tr>
                    @endforeach
                    {{-- total --}}
                    <tr class="border-t bg-slate-500">
                        {{-- <td class="border"></td> --}}
                        <td colspan="2" class="border text-left text-sm pl-5 text-white py-1">Total Visitors</td>
                        <td class="text-sm text-white border font-bold">{{$count}}</td>
                    </tr>
                </tbody>
            </table>
            @else
            <div class="p-3">
                <h2 class="text-xl">
                    Ops.. this link don't have any visitor yet!
                </h2>
                <a class="text-primary-orange" href="{{route('homepage')}}">Back to the home</a>
            </div>
            @endif

        </div>
    @endsection
</x-app-layout>