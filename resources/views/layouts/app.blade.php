<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div id="app">
        <nav class="bg-white shadow mb-6">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <a class="text-xl font-bold text-blue-600" href="{{ url('/') }}">
                    UANG MANDIRI
                </a>
                <button class="block md:hidden text-gray-700 focus:outline-none" id="navbar-toggle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="hidden md:flex space-x-4 items-center" id="navbar-menu">
                    @guest
                        @if (Route::has('login'))
                            <a class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded transition" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded transition" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="relative group">
                            <button class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none">
                                <span class="mr-2">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-50">
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
        <main class="container mx-auto px-4 py-6">
            @yield('content')
        </main>
    </div>
    <script>
        // Simple toggle for mobile nav
        document.getElementById('navbar-toggle').onclick = function() {
            var menu = document.getElementById('navbar-menu');
            menu.classList.toggle('hidden');
        };
    </script>
</body>
</html>
