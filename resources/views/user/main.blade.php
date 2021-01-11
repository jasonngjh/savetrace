<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Accounts') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 sm:px-6 lg:px-8">
            <div class="py-5 flex justify-end">
                <a href="{{ route('users.add') }}">
                    <x-jet-button>
                        {{ __('Add User Account') }}
                    </x-jet-button>
                </a>
            </div>

            <!--Search Bar -->
            <form method="GET" action="{{ route('users.search') }}">
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
            @if(isset($message))
            <div class="py-4 px-2 ">
                <div class="bg-green-100 border-l-4 border-green text-green-900 p-4" role="alert">
                    <p class="font-bold">{{$message}}</p>
                </div>
            </div>
            @endif

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-full">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">ID</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Name</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Email</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Contact Number</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Roles</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Edit</th>
                            <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$user->id}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$user->name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$user->email}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{$user->contact_number}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <div class="flex">
                                    @if($user->roles->first()->name === 'admin')
                                    <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs">{{$user->roles->first()->name}}</span>
                                    </span>
                                    @elseif( $user->roles->first()->name === 'user')
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-green-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center">{{$user->roles->first()->name}}</span>
                                    </span>
                                    @else
                                    <span class="relative inline-block px-3 py-1 font-semibold items-center text-blue-900 leading-tight">
                                        <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                        <span class="relative text-xs items-center">{{$user->roles->first()->name}}</span>
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <form method="GET" action="{{ route('users.edit') }}">
                                    <input name="userId" value="{{ $user->id }}" type="hidden">
                                    <button class="px-6 py-3 flex items-center">
                                        <svg class="w-6 text-gray-500" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td class="border-dashed border-t border-gray-200">
                                <form method="POST" action="">
                                    <input name="userId" value="{{ $user->id }}" type="hidden">
                                    <button class=" px-6 py-3 flex items-center" id="$user->id">
                                        <svg class="w-6 text-red-500" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                                            <path fillRule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clipRule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $users->links()}}
                </div>
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