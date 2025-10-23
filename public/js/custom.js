// Custom request functions
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

function submitCustomRequest(event) {
    event.preventDefault();

    const form = document.getElementById('custom-form');
    const successMessage = document.getElementById('custom-success');

    // Simulate form submission
    setTimeout(() => {
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
    }, 1500);
}