<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('logoWebArtisan.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>


</head>

<body class="font-sans">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-200">

        <x-navigation-menu />

        <!-- Page Heading -->
        @if (isset($header))

        <div class="container mx-auto pt-8">
            {{ $header }}
        </div>

        @endif

        <!-- Page Content -->
        <main class="mx-2 xl:mx-0">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')

</body>

</html>