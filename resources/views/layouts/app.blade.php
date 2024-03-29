<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="ESTA ES UNA WEB DE PRUEBA Y MUESTRA (PORTFOLIO). LOS DATOS AQUI MOSTRADOS NO SON REALES.
    Se puede interactuar con la página sin ningún problema. NO UTILIZAR LA FUNCION DE COMPRA, NO SE HACE UNA COMPRA REAL.
    PAGINA WEB CON FINES DE MUESTRA Y PRUEBA A MODO DE PORFOLIO.">
    <link rel="icon" type="image/png" href="{{ asset('logoWebArtisan.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('FlexSlider/flexslider.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jQuery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('FlexSlider/jquery.flexslider-min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=EUR">
    </script>

</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-200">

        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
