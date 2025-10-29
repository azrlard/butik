<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Butik Online - Temukan Gaya Unikmu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="h-full bg-gray-50">
    @include('shared.navbar')

    @include('home.index')

    @include('products.index')
    @include('products.components.product-detail')

    @include('cart.index')

    @include('custom.index')

    @include('shared.modal')
    @include('shared.notification')
    @include('shared.footer')
    @include('shared.scroll-to-top')

    <script>
        // Initialize app when DOM is loaded
        document.addEventListener('DOMContentLoaded', async function() {
            await loadDataFromAPI();


            // Check URL hash for initial page
            const hash = window.location.hash.substring(1); // Remove the '#'
            const validPages = ['home', 'products', 'cart', 'custom'];

            if (hash && validPages.includes(hash)) {
                navigateTo(hash);
            } else {
                navigateTo('home');
            }
        });

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(event) {
            const hash = window.location.hash.substring(1);
            const validPages = ['home', 'products', 'cart', 'custom'];

            if (hash && validPages.includes(hash)) {
                navigateTo(hash);
            }
        });
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9930afa44532051a',t:'MTc2MTIxNjc1OS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>
