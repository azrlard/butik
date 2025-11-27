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
                        primary: '#C7A07A',
                        secondary: '#E2CEB1',
                        accent: '#F7F3EE',
                        background: '#FFFFFF',
                        text: '#2F2F2F',
                        textSecondary: '#6B6B6B',
                        highlight: '#E2CEB1',
                        border: '#E2CEB1',
                        surface: '#F7F3EE',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        /* Custom enhancements for better appearance */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #C7A07A;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #E2CEB1;
        }

        /* Enhanced text selection */
        ::selection {
            background: rgba(199, 160, 122, 0.3);
            color: #2F2F2F;
        }

        /* Subtle animations */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Better focus states */
        .focus-enhanced:focus {
            outline: 2px solid #C7A07A;
            outline-offset: 2px;
        }

        /* Custom button hover effects */
        .btn-hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(199, 160, 122, 0.2);
        }

        /* Gradient text effect */
        .text-gradient {
            background: linear-gradient(135deg, #C7A07A 0%, #E2CEB1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced card shadows */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(199, 160, 122, 0.15), 0 2px 4px -1px rgba(199, 160, 122, 0.1);
        }

        .card-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(199, 160, 122, 0.2), 0 4px 6px -2px rgba(199, 160, 122, 0.15);
        }

        /* Smooth transitions for all interactive elements */
        button, a, input, select, textarea {
            transition: all 0.2s ease;
        }

        /* Loading animation */
        .loading-dots::after {
            content: '';
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }
    </style>
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