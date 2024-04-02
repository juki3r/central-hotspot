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
                                <td>Admin Income</td>
                            </thead>
                            <tbody>
                                @foreach ($active_agents as $active_agents)
                                <tr>
                                    <td  class="p-1" style="font-size: 12px">{{$active_agents->name}}</td>
                                    <td  class="p-1" style="font-size: 12px">
                                        @if($active_agents->name=="Remia Arcenas")
                                            {{$remia_total}}
                                        @endif
                                    </td>
                                    <td  class="p-1" style="font-size: 12px">
                                        @if($active_agents->name=="Remia Arcenas")
                                            {{$returnincome}}
                                        @endif
                                    </td>
                                    <td  class="p-1" style="font-size: 12px">
                                        @if($active_agents->name=="Remia Arcenas")
                                            {{$remiaincome}}
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


   

</x-app-layout>
