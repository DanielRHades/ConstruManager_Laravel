<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex flex-col h-screen">
    @include('layouts.navigation')
    <!-- Page Content -->
    <div class="flex-1 relative bg-gray-100">
        <div id="side-menu" class="absolute w-1/4 left-0 p-5 border h-full overflow-y-auto">
            @yield('side-menu-items')
        </div>
        <main class="absolute w-3/4 right-0 p-5 border h-full">
            <div class="h-1/3 overflow-y-auto w-full">
                @yield('selected-main')
            </div>
            <div class="h-2/3 border overflow-y-auto w-full">
                <div class="border-b flex">
                    @yield('buttons-submenu')
                </div>
                <div class="mt-2">
                    @yield('selected-submenu')
                </div>
            </div>
        </main>
    </div>
    </div>
</body>

</html>
