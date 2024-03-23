<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status') }}
        </h2>
    </x-slot>
   

    {{-- AGENTS --}}
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                        {{-- TOTAL SALES --}}
                        <div class="card shadow">
                            <div class="card-header">
                                <h1>Total Sale</h1>
                            </div>
                            <div class="card-body">
                                &#8369; {{ $totalsale }} . 00
                            </div>
                        </div>
                        </div>
                         {{-- TOTAL Commision --}}
                        <div class="col-6">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h1>Income</h1>
                                </div>
                                <div class="card-body">
                                    &#8369; {{ $agentincome }} . 00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   

</x-app-layout>
