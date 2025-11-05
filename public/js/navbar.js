// User Menu Dropdown Functionality - Simplified
function toggleUserMenu() {
    const dropdown = document.querySelector('.user-menu-dropdown');
    if (!dropdown) return;

    dropdown.classList.toggle('hidden');
}

function closeUserMenu() {
    const dropdown = document.querySelector('.user-menu-dropdown');
    if (dropdown) {
        dropdown.classList.add('hidden');
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const container = document.querySelector('.user-menu-container');
    const dropdown = document.querySelector('.user-menu-dropdown');
    
    if (container && dropdown && !container.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});

// Close dropdown on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeUserMenu();
    }
});

// Mobile menu functionality
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) {
        mobileMenu.classList.toggle('hidden');
    }
}