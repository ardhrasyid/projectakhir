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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        
        {{-- <div class="min-h-screen flex flex-col sm:flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-900 dark:bg-gray-900"> --}}
            <div class="sm:row-span-6 mt-2 sm:mt-0 flex justify-center">
                <img src="{{ asset('img/logo.png') }}" alt="Deskripsi Gambar" width="200" height="200">
            </div>
            {{-- <div class=" bg-green-900 w-screen h-screen"> --}}

            <div class="sm:row-span-6 mt-2 sm:mt-0 flex justify-center">
                <div class="w-full sm:max-w-md mt-10 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg mx-auto">
                    <h1 class="text-center font-bold text-2xl">Login</h1>
                    {{ $slot }}
                </div>
            </div>
        </div>
        </div>
        
        <!--Start Background Animation Body-->
        <div class="area fixed top-0 left-0 w-full h-full z-[-1]">
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <!--End Background Animation Body-->
        
    </body>
</html>
