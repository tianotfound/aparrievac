<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('logo/aparri.png') }}">
    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 JS and CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Style -->
    <style>
        body{
            font-family: 'Inter', sans-serif;
            background-color: #f0f0f0;
            background-image: linear-gradient(rgba(255, 0, 0, 0.5)), url('https://scontent.fcrk1-3.fna.fbcdn.net/v/t39.30808-6/514834420_1238737011366605_5573957893768264569_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeFehKWi1uBHdXHHZXDSoqEJqTURjH6FZz6pNRGMfoVnPttD101snubL7B83S9vd6MZLUiWkhg7IYS1_bM3KYeqm&_nc_ohc=OYKqCbLVTqAQ7kNvwG--5fi&_nc_oc=Adn67MwAqXt981c2tWHGJavHt_PcFBRshYSZpFs0Gocj5NBsYR5MMdlNhY29LbQpdPY&_nc_zt=23&_nc_ht=scontent.fcrk1-3.fna&_nc_gid=xoq6mzZGLzInf28XrDw6MA&oh=00_AfSOChrBABVTJl70yo6JhNCg00u5SzUlP-oTh945YO6tgw&oe=68860E90');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: #333;
        }
    </style>

</head>
<body>
    <div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
