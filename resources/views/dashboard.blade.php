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
                            <h1 class="fs-4 mb-4" style="text-transform: capitalized">Hello, {{ Auth::user()->usertype}}</h1>
                    <form action="{{ route('import.voucher') }}" enctype="multipart/form-data" method="post" class="w-25" >
                        @csrf
                        <div class="input-group">
                            <input type="file" name="voucher_file">
                            <x-primary-button class="">Import</x-primary-button>
                        </div>
                    </form>
                    {{-- END Card --}}
                    <div class="card shadow-sm mt-2">
                        <div class="card-header">
                            <h4 class="fs-1 mt-5">Vouchers</h4>
                        </div>
                        <div class="card-body">
                            <div class="responsive-table">
                                <table class="table table-bordered text-nowrap" id="sortTable">
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
                    <h1 class="fs-4 mb-4" style="text-transform: capitalized">Hello, {{ Auth::user()->usertype}}</h1>
                    <form action="{{route('search.voucher')}}" method="post">
                        @csrf
                        <label for="voucher_search">Enter price to search voucher :</label>
                        <select name="voucher_search" class="form-control" required>
                            <option value="">Select Price</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
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
                            <div class="responsive-table">
                                <form action="{{route('sell')}}" method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Price</th>
                                            <th>Voucher</th>
                                        </tr>
                                        <tr>
                                            <td>{{$voucher_price}} pesos only !</td>                                       
                                            <td><input type="text" name="sell_confirm" value="{{$voucher_to_sell}}" style="border: none" readonly></td>
                                        </tr>
                                    </table>
                                    <x-primary-button type="submit">Sell</x-primary-button>
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
                    <h1 class="fs-4 mb-4" style="text-transform: capitalized">Hello, {{ Auth::user()->usertype}}</h1>
                </div>
            </div>
        </div>
    </div>

    @endif

</x-app-layout>
