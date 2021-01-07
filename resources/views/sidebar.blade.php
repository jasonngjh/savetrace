<aside class="bg-white border-gray-100 max-h-full md:min-h-screen mx-auto" x-data="{ isOpen: false }">
    <div class="px-6 py-6 md:block" :class="isOpen? 'block': 'hidden'">
        @role('admin')
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('users') }}" :active="request()->routeIs('users*')">
                {{ __('User Accounts') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Internal Doctors') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                {{ __('External Doctors') }}
            </x-jet-responsive-nav-link>
        </div>
        @else
        <ul>
            <li class="px-2 py-3 hover:bg-blue-400 rounded">
                <a href="#" class="flex items-center">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="mx-2 text-gray-800">Dashboard</span>
                </a>
            </li>
            <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2">
                <a href="#" class="flex items-center">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Team</span>
                </a>
            </li>
            <li class="px-2 py-3 hover:bg-gray-900 rounded mt-2">
                <a href="#" class="flex items-center">
                    <svg class="w-6 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="mx-2 text-gray-300">Reports</span>
                </a>
            </li>
        </ul>
        @endrole
    </div>
</aside>