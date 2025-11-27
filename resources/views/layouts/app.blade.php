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
                        primary: '#391E10',
                        secondary: '#734128',
                        accent: '#E2CEB1',
                        background: '#FFFFFF',
                        text: '#4A4A4A',
                        textSecondary: '#7A7A7A',
                        highlight: '#C7A07A',
                        border: '#D6C4AF',
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
            background: #c7a07a;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b8946a;
        }

        /* Enhanced text selection */
        ::selection {
            background: rgba(57, 30, 16, 0.2);
            color: #391e10;
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
            outline: 2px solid #391e10;
            outline-offset: 2px;
        }

        /* Custom button hover effects */
        .btn-hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(57, 30, 16, 0.15);
        }

        /* Gradient text effect */
        .text-gradient {
            background: linear-gradient(135deg, #391e10 0%, #734128 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced card shadows */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(57, 30, 16, 0.1), 0 2px 4px -1px rgba(57, 30, 16, 0.06);
        }

        .card-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(57, 30, 16, 0.1), 0 4px 6px -2px rgba(57, 30, 16, 0.05);
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