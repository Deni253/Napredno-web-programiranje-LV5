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
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    
                    <div>
                        <a href="{{ route('lang.switch', 'hr') }}">HR</a> |
                        <a href="{{ route('lang.switch', 'en') }}">EN</a>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            @auth
                @if(auth()->user()->role === 'nastavnik' && request()->routeIs('tasks.create') === false)
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('tasks.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Dodaj novi rad
                        </a>
                    </div>
                @endif
            @endauth

            @auth
                @if(auth()->user()->role === 'nastavnik' && request()->routeIs('tasks.view') === false)
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('tasks.view') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Pogledaj svoje radove
                        </a>
                    </div>
                @endif
            @endauth



            @auth
                @if(auth()->user()->role === 'admin' && request()->routeIs('admin.users') === false)
                <div class="flex mt-6 justify-center">
                    <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Upravljaj korisnicima
                    </a>
                </div>
                @endif
            @endauth

            @auth
                @if(auth()->user()->role === 'student' && request()->routeIs('student.see') === false)
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('student.see') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Pogledaj dostupne radove
                        </a>
                    </div>
                @endif
            @endauth

        </div>
    </body>
</html>
