// Navigation functions
async function navigateTo(page) {
    try {
        // Show loading state
        showPageLoading();

        // Update active menu state
        updateActiveMenuState(page);

        // Hide all pages with fade effect
        document.querySelectorAll('.page').forEach(p => {
            p.classList.remove('active');
            p.classList.add('hidden');
        });

        // Small delay for smooth transition
        await new Promise(resolve => setTimeout(resolve, 150));

        // Show selected page
        const targetPage = document.getElementById(page);
        if (targetPage) {
            targetPage.classList.remove('hidden');
            targetPage.classList.add('active');
            currentPage = page;

            // Update URL hash without triggering page reload
            if (window.location.hash !== '#' + page) {
                history.pushState(null, null, '#' + page);
            }

            // Load page content based on page type
            await loadPageContent(page);

            // Scroll to top smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            console.error('Page not found:', page);
            showErrorMessage('Halaman tidak ditemukan');
        }

    } catch (error) {
        console.error('Navigation error:', error);
        showErrorMessage('Terjadi kesalahan saat memuat halaman');
    } finally {
        // Hide loading state
        hidePageLoading();

        // Close mobile menu
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu) {
            mobileMenu.classList.add('hidden');
        }
    }
}

async function loadPageContent(page) {
    switch (page) {
        case 'home':
            await Promise.all([
                loadCategories(),
                loadFeaturedProducts()
            ]);
            break;
        case 'products':
            await loadAllProducts();
            break;
        case 'cart':
            await loadCartItems();
            break;
        case 'custom':
            await loadProductsForCustom();
            break;
        default:
            console.warn('Unknown page:', page);
    }
}

function updateActiveMenuState(activePage) {
    // Remove active state from all menu items
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('bg-indigo-50', 'text-indigo-600');
        link.classList.add('text-gray-700');
    });

    // Add active state to current page menu item
    const activeLink = document.querySelector(`[onclick="navigateTo('${activePage}')"]`);
    if (activeLink) {
        activeLink.classList.remove('text-gray-700');
        activeLink.classList.add('bg-indigo-50', 'text-indigo-600');
    }
}

function showPageLoading() {
    let loader = document.getElementById('page-loader');
    if (!loader) {
        loader = document.createElement('div');
        loader.id = 'page-loader';
        loader.className = 'fixed inset-0 bg-white/80 backdrop-blur-sm z-50 flex items-center justify-center';
        loader.innerHTML = `
            <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-indigo-200 border-t-indigo-600 mb-4"></div>
                <p class="text-gray-600 font-medium">Memuat halaman...</p>
            </div>
        `;
        document.body.appendChild(loader);
    }
    loader.classList.remove('hidden');
}

function hidePageLoading() {
    const loader = document.getElementById('page-loader');
    if (loader) {
        loader.classList.add('hidden');
        setTimeout(() => loader.remove(), 300);
    }
}

function showErrorMessage(message) {
    // Create error notification
    const notification = document.createElement('div');
    notification.className = 'fixed top-20 right-4 bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 max-w-sm';
    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>${message}</span>
        </div>
    `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('opacity-0', 'transition-opacity', 'duration-300');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

function toggleMobileMenu() {
    document.getElementById('mobile-menu').classList.toggle('hidden');
}
