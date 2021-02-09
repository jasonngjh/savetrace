<div class="px-4">
    <div class="flex justify-end py-2 px-4">
        @if((Auth::user()->hasRole(['internal|external'])) and (Auth::user()->role_id != $doctor_id))
        <a href="{{ route('referral.add', ['id' => $doctor_id]) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            Send A Referral
        </a>
        @endif
    </div>
    <div class="w-full flex sm:border-b sm:border-gray-300 relative flex-col sm:flex-row">
        <button class="flex-1 sm:text-center font-bold pb-3 cursor-pointer hover:text-blue-400 false tablink active '" onclick="openPage('sentReferral', this)" id="defaultOpen">
            <div class="font-bold text-gray-800 hover:text-blue-400 bg-white rounded-lg mx-1 py-3">
                <h2 class="text-4xl">{{ $referralSent->count() }} </h2>
                <p>Referral Sent</p>
            </div>
        </button>
        <button class="flex-1 sm:text-center font-medium pb-3 cursor-pointer hover:text-blue-400 false tablink" onclick="openPage('receivedReferral', this)" id="defaultOpen">
            <div class="font-bold text-gray-800 hover:text-blue-400 bg-white rounded-lg mx-1 py-3">
                <h2 class="text-4xl">{{ $referralReceived->count() }} </h2>
                <p>Referral Received</p>
            </div>
        </button>

    </div>

    <div id="sentReferral" class="tabcontent pt-2">
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Patient</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Sent By</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Place of Practice</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Sent On</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Visited On</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referralSent as $referral)
                    <form method="GET" action="">
                        <tr class="button">
                            <td class=" border-dashed border-t border-gray-200 ">
                                <span class=" text-gray-700 px-6 py-3 flex items-center">{{$referral->id}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$referral->Patient->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">Dr. {{$referral->To_Doctor->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$referral->To_Doctor->PracticePlace->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$referral->created_at}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                    @if($referral->visited_on)
                                    {{$referral->visited_on}}
                                    @else
                                    Patient Have Not Visited
                                    @endif
                                </span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <div class="flex">

                                </div>
                            </td>
                        </tr>
                    </form>
                    @empty
                    <tr class="button">
                        <td class=" border-dashed border-t border-gray-200 ">
                            <span class=" text-gray-700 px-6 py-3 flex items-center">No Available Referral</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
            </div>
        </div>
    </div>
    <div id="receivedReferral" class="tabcontent pt-2 ">
        <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
            <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                <thead>
                    <tr class="text-left">
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">ID</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Patient</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Referred From</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Place of Practice</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Received On</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Visited On</th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referralReceived as $referral)
                    <form method="GET" action="">
                        <tr class="button">
                            <td class=" border-dashed border-t border-gray-200 ">
                                <span class=" text-gray-700 px-6 py-3 flex items-center">{{$referral->id}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$referral->Patient->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">Dr. {{$referral->From_Doctor->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$referral->From_Doctor->PracticePlace->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$referral->created_at}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                    @if($referral->visited_on)
                                    {{$referral->visited_on}}
                                    @else
                                    <div wire:click="patientVisited( {{ $referral->id }} )" wire:loading.attr="disabled" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        <span>
                                            Add Patient Visit
                                        </span>
                                    </div>
                                    @endif
                                </span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <div class="flex">

                                </div>
                            </td>
                        </tr>
                    </form>
                    @empty
                    <tr class="button">
                        <td class=" border-dashed border-t border-gray-200 ">
                            <span class=" text-gray-700 px-6 py-3 flex items-center">No Available Referral</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function openPage(pageName, elmnt) {
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }

            // Show the specific tab content
            document.getElementById(pageName).style.display = "block";

            // Add the specific color to the button used to open the tab content
            elmnt.style.borderColor = "white";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>