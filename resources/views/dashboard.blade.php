<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(Auth::user()->usertype === 'admin')
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                                <div class="alert alert-success">{{session('status')}}</div>
                            @endif
                            <h1 class="fs-4 mb-4" style="text-transform: Capitalize">Hello, {{ Auth::user()->usertype}}</h1>
                    <form action="{{ route('import.voucher') }}" enctype="multipart/form-data" method="post" class="w-25" >
                        @csrf
                        <div class="input-group">
                            <input type="file" name="voucher_file">
                            <x-primary-button class="">Import</x-primary-button>
                        </div>
                    </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-nowrap p-0 m-0" id="sortTable">
                                    <thead class="fs-5">
                                        <td>Voucher</td>
                                        <td>Price</td>
                                        <td>Is it used</td>
                                        <td>Sold by</td>
                                        <td>Sold date</td>
                                    </thead>
                                    <tbody>
                                        @foreach($vouchers as $vouchers)
                                        <tr class="fs-6">
                                            <td>{{$vouchers->voucher}}</td>
                                            <td>{{$vouchers->price}}</td>
                                            <td>
                                                @if($vouchers->is_it_used == null)
                                                    NO
                                                @else 
                                                    {{$vouchers->is_it_used}}
                                                @endif 
                                            </td>
                                            <td>
                                                @if($vouchers->sold_by == null)
                                                    Undecided
                                                @else 
                                                    {{$vouchers->sold_by}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($vouchers->sold_at == null)
                                                    Undecided
                                                @else 
                                                    {{$vouchers->sold_at}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->usertype === 'agent')
    {{-- AGENTS --}}
    @if(isset($voucher_price))
    @else
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                        <div class="alert alert-success">{{session('status')}}</div>
                    @endif
                    <h1 class="fs-4 mb-4" style="text-transform: Capitalize">Hello, {{ Auth::user()->usertype}}</h1>
                    <form action="{{route('search.voucher')}}" method="post">
                        @csrf
                        <label for="voucher_search">Enter price to search voucher :</label>
                        <select name="voucher_search" class="form-control" required>
                            <option value="">Select Price</option>
                            <option value="5">&#8369; 5 . 00</option>
                            <option value="10">&#8369; 10 . 00</option>
                            <option value="20">&#8369; 20 . 00</option>
                            <option value="50">&#8369; 50 . 00</option>
                        </select>
                        <x-primary-button class="mt-3">GO</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($voucher_price))
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h1>Sell this voucher !
                                <a href="{{route('dashboard')}}" class="float-end"><x-primary-button>Back</x-primary-button></a>
                            </h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="{{route('sell')}}" method="post">
                                    @csrf
                                    <table class="table table-bordered table-sm text-nowrap p-0 m-0">
                                        <tr>
                                            <th>Price</th>
                                            <th class="mx-2">Voucher</th>
                                        </tr>
                                        <tr>
                                            <td class="mt-2 p-3">&#8369; {{$voucher_price}} . 00</td>                                       
                                            <td class="p-2"><input type="text" name="sell_confirm" value="{{$voucher_to_sell}}" style="border: none" readonly></td>
                                        </tr>
                                    </table>
                                    <x-primary-button class="mt-3" type="submit"  onclick="return confirm('Dapat napa-picture mo sa customer ang voucher o napasulat mo sa iya. Salamat Agent')">Sell</x-primary-button>
                                    <p class="mt-4">Palihog pa-picture sa customer ang voucher or ipasulat. Salamat.</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @else
    {{-- USER PAGE --}}
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fs-4 mb-4" style="text-transform: Capitalize">Hello, {{ Auth::user()->usertype}}</h1>
                </div>
            </div>
        </div>
    </div>

    @endif

</x-app-layout>
