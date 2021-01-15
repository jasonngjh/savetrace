<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Account') }}
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">

        @if(isset($message))
        <div class="py-4 px-2 ">
            <div class="bg-green-100 border-l-4 border-green text-green-900 p-4" role="alert">
                <p class="font-bold">{{$message}}</p>
            </div>
        </div>
        @endif

        @livewire('edit-user-form', [$user])
    </div>
</x-app-layout>