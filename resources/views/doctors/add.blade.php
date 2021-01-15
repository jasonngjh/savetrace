<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(strtok(Route::currentRouteName(), '.') == "internaldocs")
            Add New Internal Doctor
            @elseif(strtok(Route::currentRouteName(), '.') == "externaldocs")
            Add New External Doctor
            @endif
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        @livewire('add-new-doctor-form')
    </div>
</x-app-layout>