<div>
    <x-slot name="header">
        <nav class="flex flex-wrap items-center justify-center text-base md:ml-auto md:mr-auto">
            <a href="{{ route('home') }}" class="mr-5 text-l font-semibold text-gray-600 hover:text-blue-700 {{ (request()->routeIs('home')) ? 'border-blue-400 text-base font-medium text-blue-700 focus:outline-none focus:text-blue-800 focus:bg-blue-100 focus:border-blue-700 transition duration-150 ease-in-out' : '' }}">Welcome {{ Auth::user()->name }} !</a>
        </nav>
    </x-slot>

    <div class="container px-8 py-15 mx-auto lg:px-4 text-gray-700 body-font">


    </div>
</div>