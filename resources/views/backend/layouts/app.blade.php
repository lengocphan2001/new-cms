<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <meta name="description" content="{{ setting('meta_description') }}">

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" />
    <link rel="icon" type="image/svg" href="{{asset('images/favicon.svg')}}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicon.svg')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    @vite(['resources/assets/css/app-backend.scss'])
    <link href="{{ asset('vendor/fontawesome-pro/css/all.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+UI&display=swap" rel="stylesheet" />
    <!-- / Styles -->

    @stack('after-styles')
    @livewireStyles
    <!-- Styles -->

    <!-- <x-google-analytics \/> -->
</head>

<body>
    <!-- Sidebar -->
    @include('backend.includes.sidebar')
    <!-- /Sidebar -->

    <main class="wrapper d-flex flex-column min-vh-100 bg-light">
        <!-- Header -->
        @include('backend.includes.header')
        <!-- /Header -->

        <div class="body flex-grow-1">
            <div class="container-lg">

                @include('flash::message')

                <!-- Errors block -->
                @include('backend.includes.errors')
                <!-- / Errors block -->

                <!-- Main content block -->
                @yield('content')
                <!-- / Main content block -->

            </div>
        </div>

        <!-- Footer block -->
        @include('backend.includes.footer')
        <!-- / Footer block -->

    </main>

    <!-- Scripts -->
    <script src="{{asset('vendor/jquery/jquery@3.2.1-min.js')}}"></script>
    @vite(['resources/assets/js/app-backend.js'])
    @livewireScriptConfig
    @stack('after-scripts')
    <!-- / Scripts -->

</body>

</html>