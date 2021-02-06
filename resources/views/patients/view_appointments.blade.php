<x-app-layout>
    <x-slot name="header">
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="{{ route('home') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Personal Health</a>
            <a href="{{ route('referrals') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('referrals')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Referrals</a>
            <a href="{{ route('appointments') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('appointments*')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Appointments</a>
            <a href="#" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700">Payments</a>
        </nav>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- <div class="overflow-hidden shadow-xl sm:rounded-lg"> -->
                <div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                        My Appointments
                    </h2>
                    <div class="flex justify-end">
                        <!-- Make new Appointment button -->
                        <div>
                            <a href="{{ route('appointments.new') }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Request For Appointment
                            </a>
                        </div>
                    </div>
                    <div class="flex-col">
                        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                            Upcoming
                        </h2>
                        @forelse ($appointments[0] as $appointment)
                        <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500">
                            <div class="py-4 px-8 mt-3">
                                <div class="py-2 flex justify-between">
                                    <div class="flex">
                                        <div>
                                            @if($appointment->cancelled)
                                            <span class="relative inline-block px-3 py-1 font-semibold items-center text-red-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative text-xs items-center">Cancelled</span>
                                            </span>
                                            @else
                                            @if($appointment->doctor_confirmation)
                                            <span class="relative inline-block px-3 py-1 font-semibold items-center text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative text-xs items-center">Confirmed</span>
                                            </span>
                                            @else
                                            <span class="relative inline-block px-3 py-1 font-semibold items-center text-yellow-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                <span class="relative text-xs items-center">Pending</span>
                                            </span>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="flex-row my-auto px-3">
                                            <div class="my-auto font-bold text-grey-200">Appointment Timing</div>
                                            <div class="my-auto ">
                                                <span class="font-normal text-grey-200">
                                                    {{$appointment->day_of_appointment . " , "}}
                                                </span>
                                                <span class="font-semibold text-grey-200">
                                                    {{$appointment->date_of_appointment}}
                                                </span>
                                                <span class="font-normal text-grey-200">
                                                    {{$appointment->time_of_appointment}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex flex-row">
                                            @if(!$appointment->cancelled)
                                            <div class="px-2">
                                                <a href="{{ route('appointments.change', ['id' => $appointment->id]) }}" class="inline-flex items-center px-4 py-2 bg-transparent border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-blue-200 active:bg-blue-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                                    Change
                                                </a>
                                            </div>
                                            @livewire('patients.cancel-appointment-button', [$appointment->id])
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-col">
                                    <div class="hover:bg-blue-100 py-2 px-2 rounded-lg w-full md:w-1/2">
                                        <a href="{{route('doctors.view', $appointment->Doctor->id)}}" class="rounded-md my-2 px-2">
                                            <div class="flex flex-row">
                                                <div class="flex">
                                                    <img class="w-10 h-10 my-3 rounded-full object-cover" src="{{ $appointment->Doctor->profile_photo_url }}" alt="{{ $appointment->Doctor->name }}">
                                                </div>
                                                <div class="flex flex-col">
                                                    <div class="my-auto pl-5 font-semibold">{{"Dr." . $appointment->Doctor->name }} </div>
                                                    <div class="my-auto pl-5 text-grey-200">{{$appointment->Doctor->PracticePlace->name }} </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        @empty
                        <div class="bg-white shadow-lg rounded-lg w-full py-5 my-4 border-l-4 border-blue-500 text-center">
                            <a href="{{ route('appointments.new') }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Request For Appointment
                            </a>
                        </div>
                        @endforelse
                        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                            Recent
                        </h2>
                        @forelse ($appointments[1] as $appointment)
                        <div class="bg-gray-100 shadow-lg rounded-lg w-full my-4 border-l-4 border-gray-500">
                            <div class="py-4 px-8 mt-3">
                                <div class="py-2 flex justify-between">
                                    <div class="flex">
                                        <div>
                                            @if($appointment->cancelled)
                                            <span class="relative inline-block px-3 py-1 font-semibold items-center text-gray-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                <span class="relative text-xs items-center">Cancelled</span>
                                            </span>
                                            @else
                                            <span class="relative inline-block px-3 py-1 font-semibold items-center text-gray-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                                                <span class="relative text-xs items-center">Passed</span>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex-row my-auto px-3">
                                            <div class="my-auto font-bold text-grey-200">Appointment Timing</div>
                                            <div class="my-auto ">
                                                <span class="font-normal text-grey-200">
                                                    {{$appointment->day_of_appointment . " , "}}
                                                </span>
                                                <span class="font-semibold text-grey-200">
                                                    {{$appointment->date_of_appointment}}
                                                </span>
                                                <span class="font-normal text-grey-200">
                                                    {{$appointment->time_of_appointment}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                                <div class="flex-col">
                                    <div class="hover:bg-blue-100 py-2 px-2 rounded-lg w-full md:w-1/2">
                                        <a href="{{route('doctors.view', $appointment->Doctor->id)}}" class="rounded-md my-2 px-2">
                                            <div class="flex flex-row">
                                                <div class="flex">
                                                    <img class="w-10 h-10 my-3 rounded-full object-cover" src="{{ $appointment->Doctor->profile_photo_url }}" alt="{{ $appointment->Doctor->name }}">
                                                </div>
                                                <div class="flex flex-col">
                                                    <div class="my-auto pl-5 font-semibold">{{"Dr." . $appointment->Doctor->name }} </div>
                                                    <div class="my-auto pl-5 text-grey-200">{{$appointment->Doctor->PracticePlace->name }} </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        @empty
                        <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-gray-500 text-center">
                            <h2 class="font-normal text-3xl text-gray-800 leading-tight py-4 px-8 mt-3">
                                No Past Appointments
                            </h2>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>