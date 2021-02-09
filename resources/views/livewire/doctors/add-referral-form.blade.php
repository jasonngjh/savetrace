<div class="py-4 mx-auto lg:px-4 text-gray-800 body-font bg-white rounded-lg">
    <form method="POST" action="{{route('referral.add.post')}}" enctype="multipart/form-data">
        @csrf
        <x-jet-input id="doctor_id" name="doctor_id" type="text" value="{{$to_doctor->id}}" autofocus hidden />
        <div class="py-2 col-span-6 sm:col-span-4">
            <x-jet-label for="doctor_name" value="{{ __('Doctor Name') }}" />
            <x-jet-input id="doctor_name" name="doctor_name" type="text" class="mt-1 block w-full bg-gray-100" value="{{$to_doctor->name}}" autofocus disabled />
            <x-jet-input-error for="doctor_name" class="mt-2" />
        </div>
        <div class="py-2 col-span-6 sm:col-span-4">
            <x-jet-label for="doctor_practice_place" value="{{ __('Doctor Practice Place') }}" />
            <x-jet-input id="doctor_practice_place" name="doctor_practice_place" type="text" class="mt-1 block w-full bg-gray-100" value="{{$to_doctor->PracticePlace->name}}" autofocus disabled />
            <x-jet-input-error for="doctor_practice_place" class="mt-2" />
        </div>
        <div class="py-2 col-span-6 sm:col-span-4">
            <x-jet-label for="patient" value="{{ __('Patient') }}" />
            <livewire:doctors.patient-select id="patient" name="patient" placeholder="Search Using Patient Name" :searchable="true" />
            <x-jet-input-error for="patient" class="mt-2" />
        </div>

        <div x-data="{fileName: null}" class="py-2  col-span-6 sm:col-span-4">
            <x-jet-label for="file" value="{{ __('Referral Letter *pdf files only') }}" />
            <input id="file" name="file" type="file" class="hidden" x-ref="file" x-on:change="
                                    fileName = $refs.file.files[0].name;
                                    reader.readAsDataURL($refs.file.files[0]);
                            " />

            <div class="flex">
                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.file.click()">
                    {{ __('Add Referral Letter') }}
                </x-jet-secondary-button>
                <x-jet-label class="px-3 my-auto" for="file" x-on="fileName" x-text="fileName" />
            </div>
            <x-jet-input-error for="file" class="mt-2" />
        </div>

        <div class="flex justify-end">
            <button class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Submit
            </button>
        </div>
    </form>
</div>