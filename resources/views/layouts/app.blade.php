<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Butik Online - Temukan Gaya Unikmu')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="h-full bg-gray-50 overflow-x-hidden font-['Poppins']">
    <div class="h-16"></div> <!-- Spacer for fixed navbar -->
    @include('shared.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('shared.footer')
    @include('shared.scroll-to-top')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>