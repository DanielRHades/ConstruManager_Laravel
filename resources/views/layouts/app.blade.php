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
            <div id="selected-main" class="max-h-1/3 overflow-y-auto w-full mb-5">
                @yield('selected-main')
            </div>
            <div id="submenu" class="max-h-2/3 overflow-y-auto w-full">
                <div id="buttons-submenu" class="empty:hidden border-b flex">
                    @yield('buttons-submenu')
                </div>
                <div id="selected-submenu" class="mt-2 border-b border-x">
                    @yield('selected-submenu')
                </div>
            </div>
        </main>
    </div>
    <script>
        document.getElementById('delete-item').addEventListener('click', function() {
            document.getElementById('form_delete').classList.remove('hidden')
        })
    </script>
</body>

</html>
