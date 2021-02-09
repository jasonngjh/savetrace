<div class="py-4 px-4">
    <div class="bg-white border shadow-sm px-4 py-3 rounded-lg w-full">
        <div class="flex items-center">
            <div class="grid grid-cols-3 w-full">
                <div class="py-4 flex flex-col col-span-2">
                    <div class="flex">
                        <div class="items-top">
                            <p class="text-gray-500 px-1">#{{$patient->id }}</p>
                        </div>
                        <div class="flex-col w-full">
                            <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                                {{$patient->name}}
                            </h2>
                            <div>
                                <h2 class="font-normal text-xl text-gray-800 leading-tight">
                                    {{$patient->age}} years old
                                </h2>
                            </div>
                            <div class="flex justify-between pt-4">
                                <div>
                                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                                        {{$patient->contact_number}}
                                    </h2>
                                </div>
                                <div>
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                        {{$patient->address}}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col py-6 px-6">
                        <h2 class="font-normal text-xl text-gray-800 leading-tight">
                            Emergency Contact
                        </h2>
                        <div class="pt-4">
                            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                                {{$patient->name_of_emergency_contact}}
                            </h2>
                            <h2 class="font-normal text-xl text-gray-800 leading-tight">
                                {{$patient->contact_number_of_emergency_contact}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="flex-col col-span-1 justify-center content-end hidden md:flex">
                    <img class="w-40 h-40 my-3 rounded-full mx-auto object-cover" src="{{ $patient->profile_photo_url }}" alt="{{ $patient->name }}">
                    <div class="text-center">
                        <h2 class="py-5 font-semibold text-l text-gray-800 leading-tight">
                            Patient
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>