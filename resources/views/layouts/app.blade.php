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
    @vite([ 'resources/js/dark-mode.js'])
    @if (isset($scripts))
        {{ $scripts }}
    @endif
</head>

<body class="font-sans antialiased ">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        @include('layouts.navigation')
        @auth
            <div class="p-4 sm:ml-60">
                <div class="pt-8 border-gray-200 rounded-lg dark:border-gray-700 ">
                @endauth
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
                @auth
                </div>
            </div>
        @endauth
</body>

</html>
