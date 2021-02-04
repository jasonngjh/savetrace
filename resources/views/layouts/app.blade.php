<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SaveTrace') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-blue-100">
        @livewire('navigation-dropdown')
        <!-- Page Content -->
        <div class="flex">
            @auth
            @if(!Auth::user()->hasRole("patient"))
            <div class="sticky bg-white h-screen top-0 flex-none">
                @include('sidebar')
            </div>
            @endif
            <div class="flex-auto">
                <!-- Page Heading -->
                <header class="bg-white shadow ">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                {{ $slot }}
            </div>
            @endauth
            @guest
            <div class="flex-auto">
                <!-- Page Heading -->
                <header class="bg-white shadow flex">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                {{ $slot }}
            </div>
            @endguest
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>