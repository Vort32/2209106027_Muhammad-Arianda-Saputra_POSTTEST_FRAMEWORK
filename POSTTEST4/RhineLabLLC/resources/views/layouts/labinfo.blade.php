<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo1.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-[#ECE8E5] min-h-screen relative overflow-hidden">
    @yield('content')

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
