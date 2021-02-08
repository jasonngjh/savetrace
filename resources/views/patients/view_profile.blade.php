<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Patient
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        @livewire('patients.view-patient-information-card', ['patient_id' => $patient_id])

        @auth

        @endauth
    </div>
</x-app-layout>