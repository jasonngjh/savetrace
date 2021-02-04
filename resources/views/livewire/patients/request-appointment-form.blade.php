<div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
    <h2 class="font-bold text-3xl text-gray-800 leading-tight">
        Request New Appointment
    </h2>

    <div class="flex flex-wrap">
        <div class="bg-white shadow-lg rounded-lg w-full my-4">
            <div class="py-2 px-2">
                <x-jet-label for="registration_number" value="{{ __('Registration Number *') }}" />
                <x-jet-input id="state.registration_number" type="text" class="block mt-1 w-full" wire:model.defer="state.registration_number" required />
                <x-jet-input-error for="registration_number" class="mt-2" />
            </div>
        </div>
    </div>
</div>