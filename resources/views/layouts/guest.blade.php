<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/bootstrap/4.6.0/css/bootstrap.min.css">
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @livewireScripts
    <script src="https://cdn.staticfile.org/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
</body>

</html>
