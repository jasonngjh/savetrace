<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Patient
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        @livewire('patients.view-patient-information-card', ['patient_id' => $patient_id])

        @auth
        @hasanyrole('internal|external')
        <div class="flex justify-end px-6">
            <a href="{{ route('patients.add.record', ['patient_id' => $patient_id]) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Add
            </a>
        </div>
        @livewire('patient.patient-record-list', ['patient_id' => $patient_id])
        @endhasanyrole
        @endauth
    </div>
</x-app-layout>