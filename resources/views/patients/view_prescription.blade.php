<x-app-layout>
    <x-slot name="header">
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="{{ route('home') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Personal Health</a>
            <a href="{{ route('prescription') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('prescription')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Prescriptions</a>
            <a href="{{ route('referrals') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('referrals')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Referrals</a>
            <a href="{{ route('appointments') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('appointments')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Appointments</a>
        </nav>
    </x-slot>
    @livewire('patients.view-prescription-page')
</x-app-layout>