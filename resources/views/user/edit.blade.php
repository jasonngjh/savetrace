<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Account') }}
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        <x-jet-validation-errors class="mb-4" />
        @if(isset($message))
        <div class="py-4 px-2 ">
            <div class="bg-green-100 border-l-4 border-green text-green-900 p-4" role="alert">
                <p class="font-bold">{{$message}}</p>
            </div>
        </div>
        @endif
        <form method="POST" action="{{ route('users.edit.post') }}">
            @csrf
            <x-jet-input hidden id="userId" name="userId" value="{{ $user->id }}" autocomplete="id" />

            <!-- TODO: Profile photo editing -->

            <!-- Name -->
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $user->name }}" autocomplete="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ $user->email}}" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <!-- Contact Number -->
            <div class="mt-4">
                <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
                <x-jet-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" value="{{ $user->contact_number}}" />
                <x-jet-input-error for="contact_number" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-jet-label for="role" value="{{ __('Roles') }}" />
                <select id="role " name="role" wire:model="role" class="block mt-1 w-full form-input rounded-md shadow-sm" :value="old('role ')">
                    <option value='{{ $user->roles->first()->name }}'>{{ $user->roles->first()->name }}</option>
                    @foreach($roles as $role)
                    <option value={{ $role->name }}>{{ $role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex mt-4 justify-end">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>

    </div>
</x-app-layout>