<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/png" href="{{asset('images/favicon.svg')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/favicon.svg')}}">

    <!-- Styles -->
    @stack('before-styles')
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    @stack('after-styles')
</head>

<body>
    <div class="text-gray-900 antialiased">
        {{ $slot }}
    </div>

    <!-- Scripts -->
    <script type="module" src="{{ asset('js/base.js') }}" defer></script>
</body>

</html>