<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Doctor
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        @livewire('view-doctor-information-card', ['doctor_id' => $id])

        @auth
        @if(Auth::user()->hasRole(['internal','external','nurse']))
        @livewire('doctor-referrals-tabs', ['doctor_id' => $id])
        @if(Auth::user()->role_id == $id)
        <h2>im this person</h2>
        @else
        <h2>im not this person</h2>
        @endif
        @else
        <div>
            @livewire('doctor-information-component',['doctor_id' => $id])
        </div>
        @endif
        @endauth

        @guest
        <div>
            @livewire('doctor-information-component',['doctor_id' => $id])
        </div>
        @endguest
    </div>
</x-app-layout>