<div>
    <x-slot name="header">
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="{{ route('home') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Welcome {{ Auth::user()->name }} !</a>
        </nav>
    </x-slot>

    <div class="flex-col w-full">
        <div class="flex">
            <div class="mr-1 mb-2 px-2 py-1 bg-white rounded-md shadow w-1/2">
                <div>
                    <h2 class="font-semibold text-xl py-3">Pending Appointments</h2>
                </div>
                <div>
                    @if(count($pending_appointments) == 0)
                    <div class="flex py-4">
                        <div class="w-full text-center">
                            <span class="text-sm text-gray-600 block">No Pending Appointments!</span>
                        </div>
                    </div>
                    @else
                    <table class="border-collapse w-full">
                        <thead>
                            <tr>
                                <th class="p-1 font-bold  bg-blue-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Date</th>
                                <th class="p-1 font-bold  bg-blue-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Patient</th>
                                <th class="p-1 font-bold  bg-blue-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pending_appointments as $pending_appt)
                            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="text-sm text-gray-800 block">{{ (new DateTime($pending_appt->date_of_appointment))->format('D d M Y H:i') }}</span>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <form method="GET" action="{{ route('patients.view')}}">
                                        <input id="patient_id" name="patient_id" value="{{ $pending_appt->Patient->id }}" type="hidden">
                                        <button class="bg-transparent hover:underline hover:text-blue-600 font-medium">
                                            <span class="text-sm font-semibold block">{{ $pending_appt->Patient->name }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <div class="flex justify-evenly">
                                        <button wire:click="acceptAppt( {{ $pending_appt->id }})" class="flex hover:text-green-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 py-auto" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Accept
                                        </button>
                                        <button wire:click="rejectAppt( {{ $pending_appt->id }})" class="flex hover:text-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 py-auto" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Reject
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="ml-1 mb-2 px-2 py-1 bg-white rounded-md shadow w-1/2">
                <div>
                    <h2 class="font-semibold text-xl py-3">Referral Received</h2>
                </div>
                <div>
                    @if(count($referrals) == 0)
                    <div class="flex py-4">
                        <div class="w-full text-center">
                            <span class="text-sm text-gray-600 block">No New Referrals!</span>
                        </div>
                    </div>
                    @else
                    <table class="border-collapse w-full">
                        <thead>
                            <tr>
                                <th class="p-1 font-bold  bg-blue-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Patient</th>
                                <th class="p-1 font-bold  bg-blue-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Referred From</th>
                                <th class="p-1 font-bold  bg-blue-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referrals as $referral)
                            <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <form method="GET" action="{{ route('patients.view')}}">
                                        <input id="patient_id" name="patient_id" value="{{ $$referral->Patient->id }}" type="hidden">
                                        <button class="bg-transparent hover:underline hover:text-blue-600 font-medium">
                                            <span class="text-sm text-gray-800 block">{{ $referral->Patient->name }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="text-sm font-semibold block">{{ 'Dr. '. $referral->From_Doctor->name }}</span>

                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <div class="flex justify-evenly">
                                        <button wire:click="viewReferral( {{ $referral->id }})" class="flex hover:text-green-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 py-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            View
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="px-3 bg-white rounded-md shadow flex-col">
                <div>
                    <h2 class="font-semibold text-xl py-3">Appointments</h2>
                </div>
                <div>
                    <div>
                        <span class="text-gray-900 relative inline-block date uppercase font-medium tracking-wide mb-2">{{ $today_date }}</span>
                        @forelse($confirmed_appointments as $appt)
                        <div class="flex py-4">
                            <div class="w-1/12">
                                <span class="text-sm text-gray-600 block">{{ (new DateTime($appt->date_of_appointment))->format('H:i') }}</span>
                            </div>
                            <div class="w-1/12">
                                <span class="bg-blue-400 h-2 w-2 rounded-full block mt-2"></span>
                            </div>
                            <div class="w-10/12">
                                <form method="GET" action="{{ route('patients.view')}}">
                                    <input id="patient_id" name="patient_id" value="{{ $$referral->Patient->id }}" type="hidden">
                                    <button class="bg-transparent hover:underline hover:text-blue-600 font-medium">
                                        <span class="text-sm text-gray-800 block">{{ $appt->Patient->name }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="flex py-4">
                            <div class="w-full text-center">
                                <span class="text-sm text-gray-600 block">No Appointments for today!</span>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>