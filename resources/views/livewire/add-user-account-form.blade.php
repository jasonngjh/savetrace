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
            <option value={{ $role['name'] }}>{{ $role['name']}}</option>
            @endforeach
        </select>
        <x-jet-input-error for="role" class="mt-2" />
    </div>

    @if(array_key_exists('role', $state))
    @if($state['role'] == "internal" || $state['role'] == "external")
    <div class="flex mt-4">
        <button wire:model="link" wire:click.prevent="toggleLink" class="background-transparent text-blue-700 ml-4">
            {{ __('Link to existing entry') }}
        </button>
    </div>
    @endif

    @if($link)
    @if($state['role'] == "internal" || $state['role'] == "external")
    <div class="mt-4">
        <x-jet-label for="doctor_role" value="{{ __('Name') }}" />
        <livewire:doctor-select wire:model="state.role_id" name="role_id" placeholder="" :searchable="true" />
    </div>
    @endif
    @endif
    @endif


    <div class="flex items-center justify-end mt-4">
        <x-jet-button wire:click="addUserAccount" class="ml-4">
            {{ __('Add') }}
        </x-jet-button>
    </div>
</div>