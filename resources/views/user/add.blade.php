<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User Account') }}
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        @livewire('add-user-account-form')
    </div>
</x-app-layout>