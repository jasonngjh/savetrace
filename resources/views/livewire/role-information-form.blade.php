<x-jet-form-section submit="updateRoleInformation">
    <x-slot name="title">
        @if($userRole=="patient")
        {{ __('Important Information') }}
        @else
        {{ __('Employment Information') }}
        @endif
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s information.') }}
    </x-slot>

    <x-slot name="form">
        @if($userRole == "patient")
        <!-- Emergency Contact-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name_of_emergency_contact" value="{{ __('Name Of Emergency Contact') }}" />
            <x-jet-input id="name_of_emergency_contact" type="text" class="mt-1 block w-full" wire:model.defer="state.name_of_emergency_contact" autocomplete="name_of_emergency_contact" />
            <x-jet-input-error for="name_of_emergency_contact" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="contact_number_of_emergency_contact" value="{{ __('Contact Number Of Emergency Contact') }}" />
            <x-jet-input id="contact_number_of_emergency_contact" type="text" class="mt-1 block w-full" wire:model.defer="state.contact_number_of_emergency_contact" autocomplete="contact_number_of_emergency_contact" />
            <x-jet-input-error for="contact_number_of_emergency_contact" class="mt-2" />
        </div>

        <!-- Allergies-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="allergies" value="{{ __('Allergies') }}" />
            <textarea id="allergies" type="text" class="mt-1 block w-full form-input rounded-md shadow-sm" rows="5" wire:model.defer="state.allergies" autocomplete="allergies"></textarea>
            <x-jet-input-error for="allergies" class="mt-2" />
        </div>

        <!-- Date of birth -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="date_of_birth" value="{{ __('Date Of Birth') }}" />
            <x-jet-input disabled id="date_of_birth" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.date_of_birth" autocomplete="date_of_birth" />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @elseif($userRole == "internal" || $userRole == "external")
        <!-- Registration Number-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="registration_number" value="{{ __('Registration Number') }}" />
            <x-jet-input disabled id="registration_number" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.registration_number" autocomplete="registration_number" />
            <x-jet-input-error for="registration_number" class="mt-2" />
        </div>
        <!-- Specialisation-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="specialty" value="{{ __('Specialisation') }}" />
            <x-jet-input id="specialty" type="text" class="mt-1 block w-full" wire:model.defer="state.specialty" autocomplete="specialty" />
            <x-jet-input-error for="specialty" class="mt-2" />
        </div>

        <!-- Specialisation-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="fax" value="{{ __('Fax') }}" />
            <x-jet-input id="fax" type="text" class="mt-1 block w-full" wire:model.defer="state.fax" autocomplete="fax" />
            <x-jet-input-error for="fax" class="mt-2" />
        </div>

        <!-- Information-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="information" value="{{ __('Profile Information') }}" />
            <textarea id="information" type="text" class="mt-1 block w-full form-input rounded-md shadow-sm" rows="10" wire:model.defer="state.information" autocomplete="information"></textarea>
            <x-jet-input-error for="information" class="mt-2" />
        </div>

        <!-- Place of Practice-->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="practice_place" value="{{ __('Place Of Practice') }}" />
            <x-jet-input disabled id="practice_place" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.practice_place_name" autocomplete="practice_place_name" />
            <x-jet-input-error for="practice_place" class="mt-2" />
        </div>
        @endif

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>