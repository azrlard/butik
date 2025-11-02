<!-- Custom Form -->
<div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
    <!-- Form Header -->
    <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-700 text-white p-8 text-center">
        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold mb-2">Form Permintaan Custom</h3>
        <p class="text-purple-100">Isi detail permintaan Anda dengan lengkap</p>
    </div>

    <form id="custom-form" onsubmit="submitCustomRequest(event)" enctype="multipart/form-data" class="p-8">
        <!-- Personal Information -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 text-sm font-bold">1</span>
                Informasi Personal
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="customer-name" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" id="customer-name" name="customer-name" required
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        <div class="absolute left-3 top-3.5 text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="customer-email" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Email</label>
                    <div class="relative">
                        <input type="email" id="customer-email" name="customer-email" required
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        <div class="absolute left-3 top-3.5 text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="customer-phone" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Nomor Telepon</label>
                    <div class="relative">
                        <input type="tel" id="customer-phone" name="customer-phone" required
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        <div class="absolute left-3 top-3.5 text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="product-category" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Kategori Produk</label>
                    <div class="relative">
                        <select id="product-category" name="product-category" required
                                class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white appearance-none">
                            <option value="">Pilih kategori</option>
                            <option value="pakaian">👗 Pakaian</option>
                            <option value="tas">👜 Tas & Dompet</option>
                            <option value="aksesoris">💍 Aksesoris</option>
                            <option value="sepatu">👠 Sepatu</option>
                        </select>
                        <div class="absolute left-3 top-3.5 text-gray-400 group-focus-within:text-indigo-600 transition-colors pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="absolute right-3 top-3.5 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Design Description -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 text-sm font-bold">2</span>
                Detail Desain
            </h4>
            <div class="group">
                <label for="design-description" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Keterangan Desain</label>
                <textarea id="keterangan" name="keterangan" rows="6" required
                          placeholder="Jelaskan detail desain yang Anda inginkan dengan lengkap..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 resize-none bg-gray-50 focus:bg-white"></textarea>
            </div>
        </div>

        <!-- File Upload -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 text-sm font-bold">3</span>
                Upload Referensi
            </h4>
            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition-all duration-200 group cursor-pointer" onclick="document.getElementById('reference-photos').click()">
                <input type="file" id="reference-photos" name="foto_referensi" accept="image/*" class="hidden" onchange="handleFileUpload(event)">
                <div class="text-6xl mb-4 text-gray-400 group-hover:text-indigo-500 transition-colors">📷</div>
                <p class="text-gray-600 mb-2 font-semibold group-hover:text-indigo-600 transition-colors">Klik untuk upload foto referensi</p>
                <p class="text-sm text-gray-500">Format: JPG, PNG, GIF (Max 5MB per file)</p>
                <div class="mt-4 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm inline-block">
                    Pilih File
                </div>
            </div>
            <div id="uploaded-files" class="mt-4 space-y-2"></div>
        </div>

        <!-- Budget & Related Product -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mr-3 text-sm font-bold">4</span>
                Informasi Tambahan
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="harga_estimasi" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Estimasi Budget (Opsional)</label>
                    <div class="relative">
                        <input type="number" id="harga_estimasi" name="harga_estimasi" min="0" step="1000" placeholder="Masukkan estimasi harga"
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        <div class="absolute left-3 top-3.5 text-gray-400 group-focus-within:text-indigo-600 transition-colors">
                            <span class="text-sm font-semibold">Rp</span>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="produk_id" class="block text-sm font-semibold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Produk Terkait (Opsional)</label>
                    <select id="produk_id" name="produk_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        <option value="">Pilih produk jika ada</option>
                        <!-- Products will be loaded dynamically -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-8 py-4 rounded-2xl text-lg font-bold hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-[1.02] shadow-2xl shadow-purple-500/25 hover:shadow-purple-500/40 flex items-center justify-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            <span>Kirim Permintaan Custom</span>
        </button>

        <!-- Terms -->
        <p class="text-center text-sm text-gray-500 mt-4">
            Dengan mengirim form ini, Anda menyetujui
            <a href="#" class="text-indigo-600 hover:text-indigo-800 underline">syarat dan ketentuan</a> kami.
        </p>
    </form>
</div>