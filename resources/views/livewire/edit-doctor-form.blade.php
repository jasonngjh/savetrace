<div>
    @csrf
    <!-- Profile photo -->
    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
        <!-- Profile Photo File Input -->
        <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

        <x-jet-label for="photo" value="{{ __('Photo') }}" />

        <!-- Current Profile Photo -->
        <div class="mt-2" x-show="! photoPreview">
            <img src="{{ $state['profile_photo_url'] }}" alt="{{ $state['name'] }}" class="rounded-full h-20 w-20 object-cover">
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" x-show="photoPreview">
            <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
            </span>
        </div>

        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
            {{ __('Select A New Photo') }}
        </x-jet-secondary-button>

        @if ($state['profile_photo_path'])
        <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
            {{ __('Remove Photo') }}
        </x-jet-secondary-button>
        @endif

        <x-jet-input-error for="photo" class="mt-2" />
    </div>

    <!-- Registration Number -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="registration_number" value="{{ __('Registration Number') }}" />
        <x-jet-input id="registration_number" type="text" class="mt-1 block w-full" wire:model.defer="state.registration_number" />
        <x-jet-input-error for="registration_number" class="mt-2" />
    </div>

    <!-- Name -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
        <x-jet-input-error for="name" class="mt-2" />
    </div>

    <!-- Specialty -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="specialty" value="{{ __('Specialisation') }}" />
        <x-jet-input id="specialty" type="text" class="mt-1 block w-full" wire:model.defer="state.specialty" />
        <x-jet-input-error for="specialty" class="mt-2" />
    </div>

    <!-- Place of Practice -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="pp_header" value="{{ __('Place of Practice') }}" />
        <x-jet-label for="pp_name" value="{{ __('Name') }}" />
        <x-jet-input disabled id="pp_name" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.practice_place_details.name" />
        <x-jet-label for="pp_address" value="{{ __('Address') }}" />
        <x-jet-input disabled id="pp_address" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.practice_place_details.address" />
        <x-jet-label for="pp_tel" value="{{ __('Telephone') }}" />
        <x-jet-input disabled id="pp_tel" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.practice_place_details.tel" />
    </div>

    <div class="mt-4 col-span-6 sm:col-span-4">
        <div class="flex">
            <x-jet-label for="user_id" value="{{ __('User Account Details') }}" />
            @if(array_key_exists('user_details',$state))
            <button wire:click="unlink" class="background-transparent text-red-700 ml-4">
                {{ __('Unlink User Account') }}
            </button>
            @endif
        </div>

        @if(array_key_exists('user_details',$state))
        <x-jet-input disabled id="user_id" type="text" class="bg-gray-100 mt-1 block w-full" wire:model.defer="state.user_details" />
        @else
        <livewire:user-select name="user_id" placeholder="Link to an User Account" :searchable="true" />
        @endif
        <x-jet-input-error for="user_id" class="mt-2" />
    </div>

    <div class="flex mt-4 justify-end">
        <x-jet-button wire:click="editDoctor" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </div>
</div>