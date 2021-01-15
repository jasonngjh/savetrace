<div>
    <button wire:click="confirmDoctorDeletion" wire:loading.attr="disabled">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
            <title>Delete Doctor</title>
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
    <!-- Delete User Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmingDoctorDeletion">
        <x-slot name="title">
            {{ __('Delete Doctor') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this doctor?') }}

            <div class="mt-4" x-data="{}" x-on:confirming-delete-doctor.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteDoctor" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingDoctorDeletion')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteDoctor" wire:loading.attr="disabled">
                {{ __('Delete Doctor') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>