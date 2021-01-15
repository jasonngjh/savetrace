<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(strtok(Route::currentRouteName(), '.') == "internaldocs")
            Edit Internal Doctor
            @elseif(strtok(Route::currentRouteName(), '.') == "externaldocs")
            Edit External Doctor
            @endif
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        @livewire('edit-doctor-form', [$doctor])
    </div>
</x-app-layout>