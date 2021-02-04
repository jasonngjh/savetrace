<div>
    <button wire:click="confirmCancelAppointment" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
        Cancel
    </button>
    <!-- Cancel Appointment Confirmation Modal -->
    <x-jet-dialog-modal wire:model="confirmingAppointmentCancellation">
        <x-slot name="title">
            {{ __('Cancel Appointment') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to cancel this appointment?') }}

            <div class="mt-4" x-data="{}" x-on:confirming-cancel-appt.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="cancelAppt" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingAppointmentCancellation')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="cancelAppt" wire:loading.attr="disabled">
                {{ __('Cancel Appointment') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>