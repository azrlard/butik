<!-- Notification Container -->
<div id="notification-container" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

<script>
window.showNotification = function(message, type = 'info') {
    const container = document.getElementById('notification-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `pointer-events-auto flex items-center gap-3 p-4 rounded-xl shadow-xl border text-sm font-medium transition-all duration-300 transform translate-y-4 opacity-0 ${
        type === 'success' ? 'bg-green-50 text-green-900 border-green-200' :
        type === 'error' ? 'bg-red-50 text-red-900 border-red-200' :
        type === 'warning' ? 'bg-yellow-50 text-yellow-900 border-yellow-200' :
        'bg-surface text-text border-border'
    }`;

    const icon = type === 'success' ? '✓' :
                 type === 'error' ? '✕' :
                 type === 'warning' ? '⚠' : 'ℹ';

    toast.innerHTML = `
        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold ${
            type === 'success' ? 'bg-green-200 text-green-800' :
            type === 'error' ? 'bg-red-200 text-red-800' :
            type === 'warning' ? 'bg-yellow-200 text-yellow-800' :
            'bg-primary/20 text-primary'
        }">${icon}</span>
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;

    container.appendChild(toast);

    // Trigger animation
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-4', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');
    });

    // Auto remove after 4 seconds
    setTimeout(() => {
        toast.classList.remove('opacity-100', 'translate-y-0');
        toast.classList.add('opacity-0', 'translate-y-4');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
};
</script>