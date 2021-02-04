<div class="w-full h-screen">
    @csrf
    <h2 class="px-10 font-semibold text-2xl text-gray-800 leading-tight">
        Find a Doctor
    </h2>
    <div class="py-5 px-3">

        <hr>
    </div>

    <div class="py-5 px-3 w-full" submit="search">
        <!--Search Bar -->
        <x-jet-input id="q" wire:model="q" class="block mt-1 w-full" type="text" name="q" placeholder="Search By Name, Phone, Email or Specialisation" />
    </div>

    <div class="px-4 pt-4 grid">
        <div class="grid md:grid-cols-4 grid-cols-1">
            @foreach($doctors as $doctor)
            <div class="col-span-1 bg-white shadow-xl rounded-lg :hover='bg-blue-100' ">
                <div class="mt-2">
                    <img class="w-20 h-20 rounded-full mx-auto object-cover" src="{{ $doctor->profile_photo_url }}" alt="{{ $doctor->name }}">
                </div>
                <div class="p-2">
                    <h3 class="text-center text-xl text-gray-900 font-medium leading-8">{{ "Dr ". $doctor->name }}</h3>
                    <div class="text-center text-gray-400 text-xs font-semibold">
                        <p>{{ $doctor->specialty }}</p>
                    </div>
                    <table class="text-xs my-3">
                        <tbody>
                            <tr>
                                <td class="px-2 py-2 text-gray-500 font-semibold">Phone</td>
                                <td class="px-2 py-2">{{ $doctor->contact }}</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2 text-gray-500 font-semibold">Email</td>
                                <td class="px-2 py-2">{{ $doctor->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center my-3">
                        <form method="GET" action="{{ route('doctors.view', $doctor->id )}}">
                            <button class="bg-transparent text-xs text-blue-500 italic hover:underline hover:text-blue-600 font-medium">
                                View Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>