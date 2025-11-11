<!-- Hero Section -->
<section class="relative text-text py-20 lg:py-28 overflow-hidden min-h-screen">
    <!-- Swiper Carousel Background -->
    <div class="swiper hero-swiper absolute inset-0 z-0">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('/images/carosel 1.jpg');"></div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('/images/carosel 1.jpg');"></div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('/images/carosel 1.jpg');"></div>
            </div>
        </div>

        <!-- Navigation arrows -->
        <div class="swiper-button-next text-white hover:text-secondary transition-colors z-20"></div>
        <div class="swiper-button-prev text-white hover:text-secondary transition-colors z-20"></div>

        <!-- Pagination -->
        <div class="swiper-pagination z-20"></div>
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/40 z-10"></div>

    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-20 z-10" style="background-image: url('data:image/svg+xml,%3csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1000 600%22%3e%3cdefs%3e%3cpattern id=%22fashion%22 patternUnits=%22userSpaceOnUse%22 width=%22100%22 height=%22100%22%3e%3ccircle cx=%2250%22 cy=%2250%22 r=%222%22 fill=%22rgba(255,255,255,0.05)%22/%3e%3c/pattern%3e%3c/defs%3e%3crect width=%221000%22 height=%22600%22 fill=%22url(%23fashion)%22/%3e%3c/svg%3e')"></div>

    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-yellow-400/20 rounded-full blur-xl animate-pulse z-10"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-purple-400/20 rounded-full blur-xl animate-pulse delay-1000 z-10"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-pink-400/20 rounded-full blur-xl animate-pulse delay-500 z-10"></div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-20">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-8 leading-tight text-white drop-shadow-2xl">
            Temukan Gaya<br>
            <span class="text-secondary drop-shadow-2xl">Unikmu</span>
        </h1>

        <p class="text-xl md:text-2xl lg:text-3xl mb-12 opacity-90 max-w-4xl mx-auto leading-relaxed font-light text-white drop-shadow-lg">
            Produk Fashion Ready & Custom untuk Semua Gaya — Wujudkan Impian Fashion Anda Bersama Kami
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <button onclick="window.location.href='/products'" class="group bg-primary text-background px-10 py-5 rounded-2xl text-xl font-bold hover:bg-secondary transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-primary/25 hover:shadow-primary/40">
                <span class="flex items-center gap-3">
                    Belanja Sekarang
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </span>
            </button>

            <button onclick="window.location.href='/custom'" class="group border-2 border-white/50 text-white px-10 py-5 rounded-2xl text-xl font-semibold hover:bg-white/10 hover:border-white/80 transition-all duration-300 backdrop-blur-sm">
                <span class="flex items-center gap-3">
                    Custom Order
                    <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </span>
            </button>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        speed: 1000,
    });
});
</script>