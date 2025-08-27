<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
        <link rel="stylesheet" id="css-main" href="{{ asset('css/oneui.min-5.11.css') }}">
        <script src="{{ asset('js/setTheme.js') }}"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=roboto-mono:400,500,700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="page-container" style="background: url({{ asset('images/bg-auth.png') }}); background-size: cover">
            <main id="main-container">
                <div class="hero-static d-flex align-items-center">
                    <div class="content">
                        <div class="row justify-content-center push">
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                {{ $slot }}
                            </div>
                        </div>
                        <div class="fs-sm text-muted text-center">
                            <strong>{{ env('APP_NAME') }}</strong> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>                              
            </main>
        </div>

        <script src="{{ asset('js/oneui.app.min-5.11.js') }}"></script>
        <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/pages/op_auth_signin.min.js') }}"></script>
    </body>
</html>
