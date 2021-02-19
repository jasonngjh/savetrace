    <div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">
        <h2 class="font-bold text-3xl text-gray-800 leading-tight">
            Prescriptions
        </h2>
        <div class="flex flex-wrap ">
            @forelse ($prescription as $record)
            <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500">
                <div class="py-4 px-8 mt-3">
                    <div class="flex flex-col mb-8">
                        <h2 class="text-gray-900 font-bold text-2xl tracking-wide mb-2">{{ $record->name_of_record }} </h2>
                        <p class=" text-gray-500 text-base">{{ $record->information }} </p>
                    </div>
                    <div class="flex justify-between">
                        <div class="my-auto">
                            @if($record->file_path)
                            <x-jet-button wire:click="downRecord( '{{$record->id}}' )" class="ml-4 hover:text-blue-700 bg-transparent">Download Record</x-jet-button>
                            @else
                            <p class=" text-gray-500 text-base">No File</p>
                            @endif
                        </div>
                        <a href="{{route('doctors.view', $record->Doctor->id)}}">
                            <div class="hover:bg-blue-100 rounded-md py-2 px-2">
                                <img class="w-5 h-5 my-3 rounded-full mx-auto object-cover" src="{{ $record->Doctor->profile_photo_url }}" alt="{{ $record->Doctor->name }}">
                                <span>{{"Dr." . $record->Doctor->name }} </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white shadow-lg rounded-lg w-full my-4 border-l-4 border-blue-500 text-center">
                <h2 class="font-normal text-3xl text-gray-800 leading-tight py-4 px-8 mt-3">
                    No prescriptions available
                </h2>
            </div>
            @endforelse
        </div>
    </div>