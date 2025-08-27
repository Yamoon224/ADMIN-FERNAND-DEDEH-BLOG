<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="app-url" content="{{ env('APP_URL') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="">
        <meta name="author" content="EDITOSYSTEM">
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="BLOG Personnel">
        <meta property="og:site_name" content="OneUI">
        <meta property="og:description" content="Blog Personnel">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
        @stack('links')
        <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min-5.11.css') }}">
        <script src="{{ asset('js/setTheme.js') }}"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=roboto-mono:400,500,700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
            {{-- <x-aside></x-aside> --}}
            <x-nav></x-nav>
            <x-header></x-header>
            <main id="main-container">
                {{ $slot }}
            </main>
        </div>

        <script src="{{ asset('js/oneui.app.min-5.11.js') }}"></script>
        @stack('scripts')
    </body>
</html>
