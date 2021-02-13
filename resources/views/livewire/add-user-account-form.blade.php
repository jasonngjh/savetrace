<div>
    @csrf
    <div class="mt-4">
        <x-jet-label for="name" value="{{ __('Name') }}" />
        <x-jet-input id="name" wire:model.defer="state.name" class="block mt-1 w-full" type="text" name="name" required />
        <x-jet-input-error for="name" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <x-jet-input id="email" wire:model.defer="state.email" class="block mt-1 w-full" type="email" name="email" required />
        <x-jet-input-error for="email" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="password" value="{{ __('Password') }}" />
        <x-jet-input id="password" wire:model.defer="state.password" class="block mt-1 w-full" type="password" name="password" />
        <x-jet-input-error for="password" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-jet-input id="password_confirmation" wire:model.defer="state.password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
        <x-jet-input-error for="password_confirmation" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="contact_number" value="{{ __('Contact Number') }}" />
        <x-jet-input id="contact_number" wire:model.defer="state.contact_number" class="block mt-1 w-full" type="text" name="contact_number" required />
        <x-jet-input-error for="contact_number" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-jet-label for="role" value="{{ __('Role') }}" />
        <select id="role" name="role" wire:model="state.role" class="block mt-1 w-full form-input rounded-md shadow-sm">
            <option value=''>Choose a role</option>
            @foreach($roles as $role)
            <option value={{ $role['id'] }}>{{ $role['name']}}</option>
            @endforeach
        </select>
        <x-jet-input-error for="role" class="mt-2" />
    </div>

    @if(isset($state['role']))
    @if($state['role'] != "1")
    @if($user_link)
    <div class="flex mt-4">
        <button wire:key="user_account_link" wire:model="user_link" wire:click.prevent="toggleUserLink" class="background-transparent text-blue-700 ml-4">
            {{ __('Add new entry') }}
        </button>
    </div>
    @if($state['role'] == 2 || $state['role'] == 3)
    <div class="mt-4">
        <x-jet-label for="role_id" value="{{ __('Name of Doctor') }}" />
        <livewire:doctor-select id="role_id" name="role_id" wire:key="doctor_role" wire:model="state.role_id" placeholder="" :searchable="true" />
        <x-jet-input-error for="role_id" class="mt-2" />
    </div>
    @elseif($state['role'] == 4)
    <div class="mt-4">
        <x-jet-label for="role_id" value="{{ __('Name of Nurse') }}" />
        <livewire:nurse-select wire:key="nurse_role" wire:model="state.role_id" placeholder="" :searchable="true" />
        <x-jet-input-error for="role_id" class="mt-2" />
    </div>
    @endif
    @elseif(!$user_link)
    <div class="flex mt-4">
        <button wire:key="user_account_link" wire:model="user_link" wire:click.prevent="toggleUserLink" class="background-transparent text-blue-700 ml-4">
            {{ __('Link to existing entry') }}
        </button>
    </div>
    @if($practice_place_link)
    <div class="flex mt-4">
        <h2>Place of Practice *</h2>
        <button wire:key="practice_place_key" wire:model="practice_place_link" wire:click.prevent="togglePractice_place_link" class="background-transparent text-blue-700 ml-4">
            {{ __('Add new Place of Practice') }}
        </button>
    </div>
    <div class="mt-4">
        <x-jet-label for="practice_place" value="{{ __('Name of Practice of Place') }}" />
        <livewire:practice-place-select id="practice_place" name="practice_place" wire:key="practice_place_key" wire:model="state.pp_id" name="practice_place" placeholder="" :searchable="true" required />
        <x-jet-input-error for="practice_place" class="mt-2" />
    </div>
    @elseif(!$practice_place_link)
    <div class="flex mt-4">
        <h2>Place of Practice *</h2>
        <button wire:key="practice_place_key" wire:model="practice_place_link" wire:click.prevent="togglePractice_place_link" class="background-transparent text-blue-700 ml-4">
            {{ __('Link to Existing Place of Practice') }}
        </button>
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_name" value="{{ __('Name of Practice of Place') }}" />
        <x-jet-input id="place_of_practice_name" type="text" class="block mt-1 w-full" wire:model.defer="state.place_of_practice_name" required />
        <x-jet-input-error for="place_of_practice_name" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_address" value="{{ __('Address of Practice of Place') }}" />
        <textarea id="place_of_practice_address" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm" wire:model.defer="state.place_of_practice_address" required>
        {{ old('address') }}
        </textarea>
        <x-jet-input-error for="place_of_practice_address" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_area" value="{{ __('Area of Practice of Place') }}" />
        <select id="place_of_practice_area" name="place_of_practice_area" wire:model.defer="state.place_of_practice_area" class="block mt-1 w-full form-input rounded-md shadow-sm" required>
            <option value=''>Choose a area</option>
            <option value='C'>Central</option>
            <option value='N'>North</option>
            <option value='S'>South</option>
            <option value='E'>East</option>
            <option value='W'>West</option>
        </select>
        <x-jet-input-error for="place_of_practice_area" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_tel" value="{{ __('Contact Number of Practice of Place') }}" />
        <x-jet-input id="place_of_practice_tel" type="text" class="block mt-1 w-full" wire:model.defer="state.place_of_practice_tel" required />
        <x-jet-input-error for="place_of_practice_tel" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="place_of_practice_opening_time" value="{{ __('Opening Time of Practice of Place') }}" />
        <textarea id="place_of_practice_opening_time" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm" placeholder="Optional" wire:model.defer="state.place_of_practice_opening_time"></textarea>
        <x-jet-input-error for="place_of_practice_opening_time" class="mt-2" />
    </div>
    @endif
    @if($state['role'] == 2 || $state['role'] == 3)
    <div class="mt-4">
        <x-jet-label for="registration_number" value="{{ __('Doctor Registration Number *') }}" />
        <x-jet-input id="state.registration_number" type="text" class="block mt-1 w-full" wire:model.defer="state.registration_number" required />
        <x-jet-input-error for="registration_number" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="specialty" value="{{ __('Doctor Specialisation *') }}" />
        <x-jet-input id="specialty" type="text" class="block mt-1 w-full" wire:model.defer="state.specialty" required />
        <x-jet-input-error for="specialty" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-jet-label for="information" value="{{ __('Doctor Other Information') }}" />
        <textarea id="information" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm" wire:model.defer="state.information">
        {{ old('information') }}
        </textarea>
        <x-jet-input-error for="information" class="mt-2" />
    </div>
    @endif
    @endif

    @endif
    @endif


    <div class="flex items-center justify-end mt-4">
        <x-jet-button wire:key="add_user_account_button" wire:click="addUserAccount" class="ml-4">
            {{ __('Add') }}
        </x-jet-button>
    </div>
</div>