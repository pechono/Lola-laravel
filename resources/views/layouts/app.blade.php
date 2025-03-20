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

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div id="app">
        <x-banner />

        <div class="min-h-screen flex bg">
            <!-- Sidebar -->
            @include('components.menu-desplegable')

            <!-- Page Content -->
            <div id="main" class="flex-1 transition-all duration-500">
                <div class=" flex pr-2 bg-slate-100 fixed w-full rounded-lg shadow-lg border border-gray-200">
                    <button class="openbtn p-4 bg-gray-800 text-white" onclick="openNav()">☰ Menu</button>
                    @include('components.menu-info')
                </div>


                <main class="p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "18%";
            document.getElementById("main").style.marginLeft = "18%";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }

        function toggleSubMenu(id) {
            const subMenu = document.getElementById(id);
            if (subMenu.classList.contains('hidden')) {
                subMenu.classList.remove('hidden');
            } else {
                subMenu.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
