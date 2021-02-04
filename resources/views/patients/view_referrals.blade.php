<x-app-layout>
    <x-slot name="header">
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="{{ route('home') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Personal Health</a>
            <a href="{{ route('referrals') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('referrals')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Referrals</a>
            <a href="{{ route('appointments') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('appointments')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Appointments</a>
            <a href="#" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700">Payments</a>
        </nav>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- <div class="overflow-hidden shadow-xl sm:rounded-lg"> -->
                <div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                        Doctor Referrals
                    </h2>
                    <div class="flex flex-wrap ">
                        @forelse ($referrals as $referral)
                        <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500">
                            <div class="py-4 px-8 mt-3">
                                <div class="py-2">
                                    @if($referral->visited_on)
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center">Visited on {{$referral->visited_on}}</span>
                                    </span>
                                    @else
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-red-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center">Yet to Visit</span>
                                    </span>
                                    @endif
                                    <span class="my-auto text-grey-200">Referral Created on {{$referral->created_at }} </span>
                                </div>
                                <div class="flex flex-row mb-8 justify-between">
                                    <a href="{{route('doctors.view', $referral->From_doctor->id)}}" class="hover:bg-blue-100 rounded-md py-2 px-2 text-center">
                                        <div class="flex">
                                            <img class="w-7 h-7 my-3 rounded-full object-cover" src="{{ $referral->From_doctor->profile_photo_url }}" alt="{{ $referral->From_doctor->name }}">
                                            <span class="my-auto pl-5 font-semibold">{{"Dr." . $referral->From_doctor->name }} </span>
                                        </div>
                                        <span class="my-auto text-grey-200">{{$referral->From_doctor->PracticePlace->name }} </span>
                                    </a>
                                    <div class="h-full w-1/2 flex items-center justify-center my-auto">
                                        <div class=" w-full h-1 bg-blue-800 pointer-events-none text-center">
                                            <h2 class="py-2">Referred To</h2>
                                        </div>
                                    </div>
                                    <a href="{{route('doctors.view', $referral->To_doctor->id)}}" class="hover:bg-blue-100 rounded-md py-2 px-2 text-center">
                                        <div class="flex">
                                            <img class="w-7 h-7 my-3 rounded-full object-cover" src="{{ $referral->To_doctor->profile_photo_url }}" alt="{{ $referral->To_doctor->name }}">
                                            <span class="my-auto pl-5 font-semibold">{{"Dr." . $referral->To_doctor->name }} </span>
                                        </div>
                                        <span class="my-auto text-grey-200">{{$referral->To_doctor->PracticePlace->name }}</span>
                                    </a>
                                </div>
                                <div class="flex justify-between">
                                    <div class="my-auto">
                                        @if($referral->file_path)
                                        @else
                                        <p class=" text-gray-500 text-base">No File</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500 text-center">
                            <h2 class="font-normal text-3xl text-gray-800 leading-tight py-4 px-8 mt-3">
                                No Referrals available
                            </h2>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>