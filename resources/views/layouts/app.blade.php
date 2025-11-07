<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Butik Online - Temukan Gaya Unikmu')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        // Global variables for dynamic data
        let categories = [];
        let products = [];
        let cart = [];
        let currentPage = 'home';
        let filteredProducts = [];

        // User authentication status
        let userId = {{ auth()->check() ? auth()->id() : 'null' }};
        let isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

        // Load cart from localStorage after DOM is ready
        function loadCartFromStorage() {
            try {
                const savedCart = localStorage.getItem('cart');
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                    console.log('Cart loaded from localStorage:', cart.length, 'items');
                } else {
                    cart = [];
                    console.log('No cart data in localStorage, starting fresh');
                }
            } catch (error) {
                console.error('Error loading cart from localStorage:', error);
                cart = [];
            }
        }

        // Initialize cart count display
        function initializeCartDisplay() {
            const cartCountElements = document.querySelectorAll('#cart-count, #cart-count-mobile');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCountElements.forEach(element => {
                if (element) {
                    element.textContent = totalItems;
                    console.log('Cart count updated to:', totalItems, 'for element:', element.id);
                }
            });
        }

        // Load data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, loading cart from storage first...');
            loadCartFromStorage(); // Load cart data first

            console.log('Initializing cart display...');
            initializeCartDisplay(); // Initialize with loaded cart data

            console.log('Loading data from API...');
            loadDataFromAPI().then(() => {
                console.log('Data loaded, cart display should be correct now');
            });
        });
    </script>
</head>
<body class="h-full bg-gray-50 overflow-x-hidden font-['Poppins']">
    <div class="h-16"></div> <!-- Spacer for fixed navbar -->
    @include('shared.navbar')

    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('shared.footer')
    @include('shared.scroll-to-top')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
</body>
</html>