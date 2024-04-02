<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>
   

    {{-- AGENTS --}}
    
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-0 text-gray-900">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-nowrap p-0 m-0" id="sortTable">
                            <thead style="font-size: 14px; font-weight:bold">
                                <td>Vouchers</td>
                                <td>Price</td>
                                <td>Sold at</td>
                            </thead>
                            <tbody>
                                @foreach ($history as $history)
                                <tr>
                                    <td  class="p-1" style="font-size: 11px">{{$history->voucher}}</td>
                                    <td  class="p-1" style="font-size: 11px">{{$history->price}}</td>
                                    <td  class="p-1" style="font-size: 11px">{{$history->sold_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


   

</x-app-layout>
