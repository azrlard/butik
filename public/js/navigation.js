// Navigation functions
function navigateTo(page) {
    // Hide all pages
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));

    // Show selected page
    document.getElementById(page).classList.add('active');
    currentPage = page;

    // Load page content
    if (page === 'home') {
        loadCategories();
        loadFeaturedProducts();
    } else if (page === 'products') {
        loadAllProducts();
    } else if (page === 'cart') {
        loadCartItems();
    }

    // Close mobile menu
    document.getElementById('mobile-menu').classList.add('hidden');

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleMobileMenu() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
}