<div>
    <x-slot name="header">
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="{{ route('home') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Welcome {{ Auth::user()->name }} !</a>
        </nav>
    </x-slot>

    <div class="flex-col">
        <div class="flex w-full md:w-1/2 justify-evenly py-2">
            <h2 class="font-normal text-l text-gray-800 leading-tight">
                Filter By:
            </h2>
            <button class="px-2 text-blue-800" wire:click="filterWeek">Past Week</button>
            <button class="px-2 text-blue-800" wire:click="filterMonth">Past Month</button>
            <button class="px-2 text-blue-800" wire:click="filterThreeMonth">Past 3 Months</button>
            <button class="px-2 text-blue-800" wire:click="filterYear">Past Year</button>
            <button class="px-2 text-blue-800" wire:click="clearFilter">All Time</button>
        </div>
        <div class="flex-col">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
                    Referrals Sent
                </h2>
            </div>
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative flex w-full my-4">

                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Referral ID</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Sent On</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Patient Name</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Sent By</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Referred To</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Visited On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sent_referrals as $sent_ref)
                        <tr class="button">
                            <td class=" border-dashed border-t border-gray-200">
                                <span class=" text-gray-700 px-6 py-3 flex items-center">{{$sent_ref->id}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$sent_ref->created_at}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$sent_ref->Patient->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{'Dr. ' .  $sent_ref->From_doctor->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{'Dr. ' .  $sent_ref->To_doctor->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                    @if($sent_ref->visited_on)
                                    {{$sent_ref->visited_on}}
                                    @else
                                    <span>
                                        Patient Have Not Visit
                                    </span>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center">
                                <h2 class="font-normal text-l text-gray-800 leading-tight py-2">
                                    No Available Referrals Sent
                                </h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{$sent_referrals->links()}}
                </div>
            </div>
        </div>

        <div class="flex-col">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
                    Referrals Received
                </h2>
            </div>
            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative flex w-full my-4">

                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Referral ID</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Sent On</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Patient Name</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Sent By</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Referred To</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Visited On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($received_referrals as $rec_ref)
                        <tr class="button">
                            <td class=" border-dashed border-t border-gray-200 ">
                                <span class=" text-gray-700 px-6 py-3 flex items-center">{{$rec_ref->id}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$rec_ref->created_at}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$rec_ref->Patient->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{'Dr. ' .  $rec_ref->From_doctor->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{'Dr. ' .  $rec_ref->To_doctor->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                    @if($rec_ref->visited_on)
                                    {{$rec_ref->visited_on}}
                                    @else
                                    <div wire:click="patientVisited( {{ $rec_ref->id }} )" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer">
                                        <span>
                                            Add Patient Visit
                                        </span>
                                    </div>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center">
                                <h2 class="font-normal text-l text-gray-800 leading-tight py-2">
                                    No Available Referrals Received
                                </h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{$received_referrals->links()}}
                </div>
            </div>
        </div>
    </div>