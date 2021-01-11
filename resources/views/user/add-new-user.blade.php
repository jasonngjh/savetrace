<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User Account') }}
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('users.add.post') }}">
            @csrf
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
                <x-jet-input id="contact_number" class="block mt-1 w-full" type="text" name="contact_number" :value="old('contact_number')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Roles') }}" />
                <select id="role " name="role" wire:model="role" class="block mt-1 w-full form-input rounded-md shadow-sm" :value="old('role ')">
                    <option value=''>Choose a role</option>
                    @foreach($roles as $role)
                    <option value={{ $role->name }}>{{ $role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Add') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</x-app-layout>