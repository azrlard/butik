<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Butik Online - Temukan Gaya Unikmu')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8B4513',
                        secondary: '#D2691E',
                        accent: '#F5F5DC',
                        background: '#FFFFFF',
                        text: '#3E2723',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body class="h-full bg-background overflow-x-hidden font-['Poppins'] text-text">
    <div class="h-16"></div> <!-- Spacer for fixed navbar -->
    @include('shared.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('shared.footer')
    @include('shared.scroll-to-top')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const desktopCartCount = document.getElementById('cart-count-desktop');
                    const mobileCartCount = document.getElementById('cart-count-mobile');
                    if (desktopCartCount) desktopCartCount.textContent = data.count || 0;
                    if (mobileCartCount) mobileCartCount.textContent = data.count || 0;
                })
                .catch(error => console.error('Error loading cart count:', error));
        });
    </script>
</body>
</html>