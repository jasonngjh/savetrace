<div>
    <div class="py-4 px-4">
        <h2 class="py-2 font-semibold text-2xl">
            Medical History
        </h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-8 py-2 text-gray-600 font-bold tracking-wider">Name of Record</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Added By</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Place of Practice</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-8 py-2 text-gray-600 font-bold tracking-wider">Information</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider">Added On</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-4 py-2 text-gray-600 font-bold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patient_record as $record)
                    <form method="GET" action="">
                        <tr class="button">
                            <td class=" border-dashed border-t border-gray-200 ">
                                <span class=" text-gray-700 px-8 py-3 flex items-center">{{$record->name_of_record}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$record->Doctor()->first()->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$record->Doctor()->first()->PracticePlace()->first()->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 px-8 py-3">
                                <p class="text-gray-700 whitespace-pre-wrap">{{$record->information}}</p>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-4 py-3 flex items-center">{{$record->created_at}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <a href="{{ route('patients.download.record', ['id' => $record->id]) }}" type="submit" class="py-4 px-2 flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    @csrf
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-7 h-7">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </form>
                    @empty
                    <tr class="button">
                        <td class=" border-dashed border-t border-gray-200 ">
                            <span class=" text-gray-700 px-6 py-3 flex items-center">No Available Record</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
            </div>
        </div>
    </div>
</div>