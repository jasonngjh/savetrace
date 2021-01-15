<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @hasanyrole('internal|external')

                <!-- To edit homepage design at resources/views/livewire/.. -->
                @livewire('doctors.homepage')
                @endhasanyrole

                @role('patient')
                @livewire('patients.homepage')
                @endrole

                @role('employee')
                @livewire('employee.homepage')
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>