<div>
    <div class="mt-4">
        <x-jet-label for="registration_number" value="{{ __('Registration Number') }}" />
        <x-jet-input id="state.registration_number" type="text" class="block mt-1 w-full" wire:model.defer="state.registration_number" required />
        <x-jet-input-error for="registration_number" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <x-jet-input id="name" type="text" class="block mt-1 w-full" wire:model.defer="state.name" required />
        <x-jet-input-error for="name" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="specialty" value="{{ __('Specialisation') }}" />
        <x-jet-input id="specialty" type="text" class="block mt-1 w-full" wire:model.defer="state.specialty" required />
        <x-jet-input-error for="specialty" class="mt-2" />
    </div>

    @if($link)
    <div class="flex mt-4">
        <h2>Place of Practice</h2>
        <button wire:model="add" wire:click.prevent="toggleLink" class="background-transparent text-blue-700 ml-4">
            {{ __('Add new Place of Practice') }}
        </button>
    </div>
    <div class="mt-4">
        <x-jet-label for="practice_place" value="{{ __('Name') }}" />
        <livewire:practice-place-select wire:model="state.pp_id" name="practice_place" placeholder="" :searchable="true" />
    </div>
    @elseif(!$link)
    <div class="flex mt-4">
        <h2>Place of Practice</h2>
        <button wire:model="link" wire:click.prevent="toggleLink" class="background-transparent text-blue-700 ml-4">
            {{ __('Link to Existing Place of Practice') }}
        </button>
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_name" value="{{ __('Name') }}" />
        <x-jet-input id="place_of_practice_name" type="text" class="block mt-1 w-full" wire:model.defer="state.place_of_practice_name" required />
        <x-jet-input-error for="place_of_practice_name" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_address" value="{{ __('Address') }}" />
        <textarea id="place_of_practice_address" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm" wire:model.defer="state.place_of_practice_address" required></textarea>
        <x-jet-input-error for="place_of_practice_address" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_tel" value="{{ __('Contact Number') }}" />
        <x-jet-input id="place_of_practice_tel" type="text" class="block mt-1 w-full" wire:model.defer="state.place_of_practice_tel" required />
        <x-jet-input-error for="place_of_practice_tel" class="mt-2" />
    </div>
    @endif



    <div class="flex items-center justify-end mt-4">
        <x-jet-button wire:click="addNewDoctor" class="ml-4">
            {{ __('Add') }}
        </x-jet-button>
    </div>
</div>