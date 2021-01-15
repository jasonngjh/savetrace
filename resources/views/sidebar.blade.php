<aside class="bg-white border-gray-100 max-h-full md:min-h-screen mx-auto" x-data="{ isOpen: false }">
    <div class="px-6 py-6 md:block" :class="isOpen? 'block': 'hidden'">
        @role('admin')
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('users') }}" :active="request()->routeIs('users*')">
                {{ __('User Accounts') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('internaldocs') }}" :active="request()->routeIs('internaldocs*')">
                {{ __('Internal Doctors') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('externaldocs') }}" :active="request()->routeIs('externaldocs*')">
                {{ __('External Doctors') }}
            </x-jet-responsive-nav-link>
        </div>
        @else
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home*')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
        </div>
        @endrole

        @hasanyrole('internal|external')
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home*')">
                {{ __('Patients') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home*')">
                {{ __('Appointments') }}
            </x-jet-responsive-nav-link>
        </div>
        @endhasanyrole

        @role('patient')
        @livewire('patients.homepage')
        @endrole

        @role('employee')
        @livewire('employee.homepage')
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home*')">
                {{ __('Doctors') }}
            </x-jet-responsive-nav-link>
        </div>
        <div class="px-2 py-3 ">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home*')">
                {{ __('Patients') }}
            </x-jet-responsive-nav-link>
        </div>
        @endrole
    </div>
</aside>