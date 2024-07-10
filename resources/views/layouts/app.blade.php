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
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  <!-- Scripts -->
  
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body>
  @include('partials.preloader')
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')
    <div class="flex h-screen overflow-hidden">
      @include('partials.sidebar')
      <div class="relative flex flex-1 flex-col pt-10 overflow-y-auto overflow-x-hidden">
        <main>
          {{ $slot }}
        </main>
      </div>
    </div>
  </div>
  </div>
</body>
</html>