<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Medical Record
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-4 px-6 lg:px-8 text-gray-800 body-font bg-white rounded-lg">
            <form method="POST" action="{{route('patients.add.record.post')}}" enctype="multipart/form-data">
                @csrf
                <x-jet-input id="patient_id" name="patient_id" type="text" value="{{$patient->id}}" autofocus hidden />
                <div class="py-2 col-span-6 sm:col-span-4">
                    <x-jet-label for="patient_name" value="{{ __('Patient Name') }}" />
                    <x-jet-input id="patient_name" name="patient_name" type="text" class="mt-1 block w-full bg-gray-100" value="{{$patient->name}}" autofocus disabled />
                    <x-jet-input-error for="patient_name" class="mt-2" />
                </div>
                <div class="py-2 col-span-6 sm:col-span-4">
                    <x-jet-label for="name_of_record" value="{{ __('Name of Record') }}" />
                    <x-jet-input id="name_of_record" name="name_of_record" type="text" class="mt-1 block w-full" :value="old('name_of_record')" autofocus />
                    <x-jet-input-error for="name_of_record" class="mt-2" />
                </div>
                <div class="py-2 col-span-6 sm:col-span-4">
                    <x-jet-label for="information" value="{{ __('Information') }}" />
                    <textarea id="information" name="information" type="text" class="block mt-1 w-full form-input rounded-md shadow-sm" required>
                    {{old('information')}}
                    </textarea>
                    <x-jet-input-error for="information" class="mt-2" />
                </div>

                <div x-data="{fileName: null}" class="py-2  col-span-6 sm:col-span-4">
                    <x-jet-label for="file" value="{{ __('Medical Record File *pdf files only') }}" />
                    <input id="file" name="file" type="file" class="hidden" x-ref="file" x-on:change="
                                    fileName = $refs.file.files[0].name;
                                    reader.readAsDataURL($refs.file.files[0]);
                            " />

                    <div class="flex">
                        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.file.click()">
                            {{ __('Upload Medical Record') }}
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
    </div>
</x-app-layout>