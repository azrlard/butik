// Custom request functions
async function loadProductsForCustom() {
    try {
        const response = await fetch('/api/products');
        const products = await response.json();

        const select = document.getElementById('produk_id');
        select.innerHTML = '<option value="">Pilih produk jika ada</option>';

        products.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.textContent = product.nama_produk;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading products for custom:', error);
    }
}

function handleFileUpload(event) {
    const files = event.target.files;
    const container = document.getElementById('uploaded-files');

    container.innerHTML = '';

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const fileDiv = document.createElement('div');
        fileDiv.className = 'flex items-center justify-between bg-indigo-50 rounded-lg p-3 border border-indigo-200';
        fileDiv.innerHTML = `
            <div class="flex items-center space-x-3">
                <span class="text-indigo-600">📎</span>
                <span class="text-sm font-medium text-gray-700">${file.name}</span>
            </div>
            <span class="text-xs text-gray-500 font-medium">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
        `;
        container.appendChild(fileDiv);
    }
}

async function submitCustomRequest(event) {
    event.preventDefault();

    const form = document.getElementById('custom-form');
    const successMessage = document.getElementById('custom-success');
    const formData = new FormData(form);

    // Add user_id (should be from authentication)
    formData.append('user_id', '1'); // Default user ID

    try {
        const response = await fetch('/api/custom-requests', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: formData
        });

        if (response.ok) {
            const result = await response.json();
            form.classList.add('hidden');
            successMessage.classList.remove('hidden');

            showNotification('Custom request berhasil dikirim! Tim kami akan menghubungi Anda segera.');

            // Reset form after showing success
            setTimeout(() => {
                form.reset();
                document.getElementById('uploaded-files').innerHTML = '';
                form.classList.remove('hidden');
                successMessage.classList.add('hidden');
            }, 8000);
        } else {
            throw new Error('Failed to submit custom request');
        }
    } catch (error) {
        console.error('Custom request error:', error);
        showNotification('Terjadi kesalahan saat mengirim custom request. Silakan coba lagi.');
    }
}