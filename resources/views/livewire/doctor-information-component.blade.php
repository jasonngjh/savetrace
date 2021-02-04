<div class="flex-cols md:flex py-4 px-4">
    <div class="w-full md:w-1/3 flex-cols py-4 px-4">
        <div class="text-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight pb-2">
                Contact Information
            </h2>
        </div>
        <div class="bg-white border shadow-sm px-4 py-4 rounded-lg w-full ">
            <div class="flex py-2">
                <div class="w-5 h-5 my-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="font-normal text-xl text-gray-800 leading-tight py-auto px-2">
                    <a href="mailto:{{$doctor_information->first()->email}}" class="hover:text-blue-800">{{ $doctor_information->first()->email }}</a>
                </h2>
            </div>
            <div class="flex py-2">
                <div class="w-5 h-5 my-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="font-normal text-xl text-gray-800 leading-tight pb-2">
                    {{ $doctor_information->first()->fax }}
                </h2>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight pt-2">
                    Practice Place
                </h2>
                <p class="font-bold">
                    {{ $doctor_information->first()->PracticePlace->name }}
                </p>
                <p>
                    {{ $doctor_information->first()->PracticePlace->address }}
                </p>
                <p>
                    {{ $doctor_information->first()->PracticePlace->tel }}
                </p>
                <p>
                    {{ $doctor_information->first()->PracticePlace->opening_time }}
                </p>
            </div>
        </div>
    </div>
    <div class="w-full md:w-2/3 flex-cols py-4 px-4">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight pb-2">
                About
            </h2>
        </div>
        <div class="bg-white border shadow-sm px-4 py-4 rounded-lg w-full">
            <h2 class="font-semibold text-ll text-gray-800 leading-tight">
                {{ $doctor_information->first()->information }}
            </h2>
        </div>
    </div>
</div>