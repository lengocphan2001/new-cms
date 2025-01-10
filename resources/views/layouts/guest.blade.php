<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
</head>

<body>
    <div class="text-gray-900 antialiased">
        {{ $slot }}
    </div>

    <!-- Scripts -->
    <script type="module" src="{{ asset('js/base.js') }}" defer></script>
</body>

</html>