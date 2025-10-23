<!-- Custom Form -->
<div class="bg-white rounded-xl shadow-lg p-8">
    <form id="custom-form" onsubmit="submitCustomRequest(event)">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="customer-name" class="block text-sm font-semibold text-gray-800 mb-2">Nama Lengkap</label>
                <input type="text" id="customer-name" name="customer-name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
            </div>
            <div>
                <label for="customer-email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                <input type="email" id="customer-email" name="customer-email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
            </div>
            <div>
                <label for="customer-phone" class="block text-sm font-semibold text-gray-800 mb-2">Nomor Telepon</label>
                <input type="tel" id="customer-phone" name="customer-phone" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
            </div>
            <div>
                <label for="product-category" class="block text-sm font-semibold text-gray-800 mb-2">Kategori Produk</label>
                <select id="product-category" name="product-category" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                    <option value="">Pilih kategori</option>
                    <option value="pakaian">Pakaian</option>
                    <option value="tas">Tas & Dompet</option>
                    <option value="aksesoris">Aksesoris</option>
                    <option value="sepatu">Sepatu</option>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <label for="design-description" class="block text-sm font-semibold text-gray-800 mb-2">Keterangan Desain</label>
            <textarea id="design-description" name="design-description" rows="6" required placeholder="Jelaskan detail desain yang Anda inginkan, termasuk warna, ukuran, bahan, dan spesifikasi lainnya..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors resize-none"></textarea>
        </div>

        <div class="mb-6">
            <label for="reference-photos" class="block text-sm font-semibold text-gray-800 mb-2">Upload Foto Referensi</label>
            <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-indigo-400 transition-colors">
                <input type="file" id="reference-photos" name="reference-photos" accept="image/*" multiple class="hidden" onchange="handleFileUpload(event)">
                <div onclick="document.getElementById('reference-photos').click()" class="cursor-pointer">
                    <div class="text-6xl mb-4">📷</div>
                    <p class="text-gray-600 mb-2 font-semibold">Klik untuk upload foto referensi</p>
                    <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max 5MB per file)</p>
                </div>
                <div id="uploaded-files" class="mt-4 space-y-2"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label for="budget-estimate" class="block text-sm font-semibold text-gray-800 mb-2">Estimasi Budget</label>
                <select id="budget-estimate" name="budget-estimate" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
                    <option value="">Pilih range budget</option>
                    <option value="100000-300000">Rp 100.000 - Rp 300.000</option>
                    <option value="300000-500000">Rp 300.000 - Rp 500.000</option>
                    <option value="500000-1000000">Rp 500.000 - Rp 1.000.000</option>
                    <option value="1000000+">Di atas Rp 1.000.000</option>
                </select>
            </div>
            <div>
                <label for="deadline" class="block text-sm font-semibold text-gray-800 mb-2">Target Selesai</label>
                <input type="date" id="deadline" name="deadline" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-colors">
            </div>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-4 rounded-xl text-lg font-semibold hover:bg-indigo-700 transition-colors custom-shadow">
            Kirim Permintaan Custom
        </button>
    </form>
</div>