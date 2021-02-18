<aside class="border-gray-100 h-screen md:w-60" x-data="{ isOpen: false }">
    <div class="pt-20 md:block" :class="isOpen? 'block': 'hidden'">
        @role('SystemAdmin')
        <a href="{{ route('users') }}" class="pl-5 my-3 rounded-r-lg flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800 {{ (request()->routeIs('users*')) ? 'border-blue-400 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="px-2">User Accounts</span>
        </a>
        <a href="{{ route('internaldocs') }}" class="pl-5 my-3 rounded-r-lg flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800 {{ (request()->routeIs('internaldocs*')) ? 'border-blue-400 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="px-2">Internal Doctors</span>
        </a>
        <a href="{{ route('externaldocs') }}" class="pl-5 my-3 rounded-r-lg flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800 {{ (request()->routeIs('externaldocs*')) ? 'border-blue-400 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="px-2">External Doctors</span>
        </a>
        @else
        <a href="{{ route('home') }}" class="pl-5 my-3 rounded-r-lg flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="px-2">Home</span>
        </a>
        @endrole

        @hasanyrole('internal|external|nurse')
        <a href="{{ route('patients') }}" class="pl-5 my-3 rounded-r-lg flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800 {{ (request()->routeIs('patients*')) ? 'border-blue-400 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="px-2">Patients</span>
        </a>
        <a href="{{ route('doctors') }}" class="pl-5 my-3 rounded-r-lg flex flex-row items-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800 {{ (request()->routeIs('doctors*')) ? 'border-blue-400 text-base font-medium text-blue-700 bg-blue-50 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">
            <svg class="w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="px-2">Doctors</span>
        </a>
        @endhasanyrole
    </div>
</aside>