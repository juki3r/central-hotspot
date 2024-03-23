<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- AGENTS --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h1>Sell this voucher !</h1>
                        </div>
                        <div class="card-body">
                            <div class="responsive-table">
                                <form action="{{ route('sell') }}" method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Price</th>
                                            <th>Voucher</th>
                                        </tr>
                                        <tr>
                                            <td>{{$voucher_price}} pesos only !</td>
                                            <td>{{$voucher_to_sell}}</td>
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
</x-app-layout>
