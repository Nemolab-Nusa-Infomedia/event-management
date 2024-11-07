<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @extends('adminlte::page')

    @section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
    | @yield('subtitle')
    @endif
    @stop

    @section('content_header')
    @hasSection('content_header_title')
    <h1 class="text-muted">
        @yield('content_header_title')

        @hasSection('content_header_subtitle')
        <small class="text-dark">
            <i class="fas fa-xs fa-angle-right text-muted"></i>
            @yield('content_header_subtitle')
        </small>
        @endif
    </h1>
    @endif
    @stop

    @section('content')
    @yield('content_body')
    @stop

    @section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>

    <strong>
        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My company') }}
        </a>
    </strong>
    @stop


    @push('js')
    <script>
        $(document).ready(function() {
            // Add your common script logic here...
        });
    </script>
    @endpush

    @push('css')
    <style type="text/css">

    </style>
    @endpush

</body>

</html>