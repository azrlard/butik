<!-- Product Detail Modal -->
<div id="product-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-4xl w-full mx-4 max-h-screen overflow-y-auto">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">Detail Produk</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
        </div>
        <div id="modal-content" class="p-6">
            <!-- Modal content will be loaded here -->
        </div>
    </div>
</div>