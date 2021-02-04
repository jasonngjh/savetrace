<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- <div class="overflow-hidden shadow-xl sm:rounded-lg"> -->
                @hasanyrole('internal|external')

                <!-- To edit homepage design at resources/views/livewire/.. -->
                @livewire('doctors.homepage')
                @endhasanyrole

                @role('patient')
                @livewire('patients.homepage')
                @endrole

                @role('nurse')
                @livewire('employees.homepage')
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>