<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-nowrap p-0 m-0" id="sortTable">
                            <thead style="font-size: 14px; font-weight:bold">
                                <td>Agents</td>
                                <td>Total Sales</td>
                                <td>Agent Income</td>
                                <td>Admin Income</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td  class="p-1" style="font-size: 12px">{{$active_agents[0]->name}}</td>
                                    <td  class="p-1" style="font-size: 12px">
                                        &#8369; {{$juki3r_total}} .00
                                    </td>
                                    <td  class="p-1" style="font-size: 12px">
                                        {{$juki3rincome}}
                                    </td>
                                    <td  class="p-1" style="font-size: 12px">
                                        &#8369; {{$juki3rreturnincome}} .00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-center">
                        <div class="col m-auto">
                            &#8369; {{$adminsells}} .00
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   

</x-app-layout>
