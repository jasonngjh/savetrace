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

    <!-- Name -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
        <x-jet-input-error for="name" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
        <x-jet-input-error for="email" class="mt-2" />
    </div>

    <!-- Contact Number -->
    <div class="mt-4 col-span-6 sm:col-span-4">
        <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
        <x-jet-input id="contact_number" type="text" class="mt-1 block w-full" wire:model.defer="state.contact_number" />
        <x-jet-input-error for="contact_number" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="role" value="{{ __('Roles') }}" />
        @if($state['roles']['id'] == '5')
        <x-jet-input id="role" name="role" type="text" class="mt-1 block w-full bg-gray-100" wire:model.defer="state.roles.name" disabled />
        @else
        <select id="role" wire:model="state.roles.id" name="role" class="block mt-1 w-full form-input rounded-md shadow-sm">
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role['name']}}</option>
            @endforeach
        </select>
        @endif

    </div>

    <div class="flex mt-4 justify-end">
        <x-jet-button wire:click="editUser" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </div>
</div>