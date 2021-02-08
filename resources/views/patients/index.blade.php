<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Patients') }}
        </h2>
    </x-slot>

    <div class="py-10 sm:px-6 lg:px-8">
        <!--Search Bar -->
        <form method="GET" action="{{ route('patients.search') }}">
            @csrf
            <div class="shadow flex">
                <input id="q" onkeyup="checkEmpty()" class="flex-auto w-full rounded p-2" type="text" placeholder="Search" name="q">
                <button id="submit" class="bg-white w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400" disabled>
                    <svg class="w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>

        <x-jet-section-border />

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recent Patients') }}
        </h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Name</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Age</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Contact Number</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td class="border-dashed border-t border-gray-200 ">
                            <span class="text-gray-700 px-6 py-3 flex items-center">{{$patient->id}}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 ">
                            <span class="text-gray-700 px-6 py-3 flex items-center">{{$patient->name}}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 ">
                            <span class="text-gray-700 px-6 py-3 flex items-center">{{$patient->age}}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200">
                            <span class="text-gray-700 px-6 py-3 flex items-center">{{$patient->contact_number}}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200">
                            <div class="flex">
                                <form method="GET" action="{{ route('patients.view')}}">
                                    <input id="patient_id" name="patient_id" value="{{ $patient->id }}" type="hidden">
                                    <button class="flex items-center">
                                        <button class="bg-transparent text-xs text-green-500 italic hover:underline hover:text-green-600 font-medium">
                                            View User
                                        </button>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center">
                            <h2 class="text-grey-800 py-2 px-2">No available patient!</h2>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $patients->links()}}
            </div>
        </div>

    </div>
</x-app-layout>


<script>
    function checkEmpty() {
        if (document.getElementById("q").value === "") {
            document.getElementById('submit').disabled = true;
        } else {
            document.getElementById('submit').disabled = false;
        }
    }
</script>