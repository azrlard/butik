<!-- Custom Form -->
<div class="bg-background rounded-3xl shadow-2xl border border-secondary overflow-hidden">
    <!-- Form Header -->
    <div class="bg-primary text-background p-8 text-center">
        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold mb-2">Form Permintaan Custom</h3>
        <p class="text-purple-100">Isi detail permintaan Anda dengan lengkap</p>
    </div>

    <form x-data="customForm()" @submit.prevent="submitForm" method="POST" action="/custom-request" enctype="multipart/form-data" class="p-8">
        @csrf
        <!-- Personal Information -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-text mb-4 flex items-center">
                <span class="w-8 h-8 bg-secondary text-background rounded-full flex items-center justify-center mr-3 text-sm font-bold">1</span>
                Informasi Personal
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="customer-name" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" id="customer-name" name="customer-name" required
                               class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                        <div class="absolute left-3 top-3.5 text-text group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="customer-email" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Email</label>
                    <div class="relative">
                        <input type="email" id="customer-email" name="customer-email" required
                               class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                        <div class="absolute left-3 top-3.5 text-text group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="customer-phone" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Nomor Telepon</label>
                    <div class="relative">
                        <input type="tel" id="customer-phone" name="customer-phone" required
                               class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                        <div class="absolute left-3 top-3.5 text-text group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="product-category" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Kategori Produk</label>
                    <div class="relative">
                        <select id="product-category" name="product-category" required
                                class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background appearance-none">
                            <option value="">Pilih kategori</option>
                            <option value="pakaian">👗 Pakaian</option>
                            <option value="tas">👜 Tas & Dompet</option>
                            <option value="aksesoris">💍 Aksesoris</option>
                            <option value="sepatu">👠 Sepatu</option>
                        </select>
                        <div class="absolute left-3 top-3.5 text-text group-focus-within:text-primary transition-colors pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div class="absolute right-3 top-3.5 text-text pointer-events-none">
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
            <h4 class="text-lg font-semibold text-text mb-4 flex items-center">
                <span class="w-8 h-8 bg-secondary text-background rounded-full flex items-center justify-center mr-3 text-sm font-bold">2</span>
                Detail Desain
            </h4>
            <div class="group">
                <label for="design-description" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Keterangan Desain</label>
                <textarea id="keterangan" name="keterangan" rows="6" required
                          placeholder="Jelaskan detail desain yang Anda inginkan dengan lengkap..."
                          class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 resize-none bg-accent focus:bg-background"></textarea>
            </div>
        </div>

        <!-- File Upload -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-text mb-4 flex items-center">
                <span class="w-8 h-8 bg-secondary text-background rounded-full flex items-center justify-center mr-3 text-sm font-bold">3</span>
                Upload Referensi
            </h4>
            <div class="border-2 border-dashed border-secondary rounded-2xl p-8 text-center hover:border-primary hover:bg-accent/50 transition-all duration-200 group cursor-pointer" @click="$refs.fileInput.click()">
                <input type="file" x-ref="fileInput" name="foto_referensi" accept="image/*" class="hidden" @change="handleFileSelect">
                <div class="text-6xl mb-4 text-text group-hover:text-primary transition-colors">📷</div>
                <p class="text-text mb-2 font-semibold group-hover:text-primary transition-colors">Klik untuk upload foto referensi</p>
                <p class="text-sm text-text">Format: JPG, PNG, GIF (Max 5MB per file)</p>
                <div class="mt-4 px-4 py-2 bg-secondary text-background rounded-lg text-sm inline-block">
                    Pilih File
                </div>
            </div>
            <div class="mt-4 space-y-2">
                <template x-for="(file, index) in selectedFiles" :key="index">
                    <div class="flex items-center justify-between bg-accent p-3 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <img :src="file.preview" class="w-10 h-10 object-cover rounded" :alt="file.name">
                            <span class="text-sm text-text" x-text="file.name"></span>
                        </div>
                        <button @click="removeFile(index)" class="text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- Budget & Related Product -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-text mb-4 flex items-center">
                <span class="w-8 h-8 bg-secondary text-background rounded-full flex items-center justify-center mr-3 text-sm font-bold">4</span>
                Informasi Tambahan
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label for="harga_estimasi" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Estimasi Budget (Opsional)</label>
                    <div class="relative">
                        <input type="number" id="harga_estimasi" name="harga_estimasi" min="0" step="1000" placeholder="Masukkan estimasi harga"
                               class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                        <div class="absolute left-3 top-3.5 text-text group-focus-within:text-primary transition-colors">
                            <span class="text-sm font-semibold">Rp</span>
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label for="produk_id" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Produk Terkait (Opsional)</label>
                    <select id="produk_id" name="produk_id"
                            class="w-full px-4 py-3 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                        <option value="">Pilih produk jika ada</option>
                        <!-- Products will be loaded dynamically -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" :disabled="isSubmitting" class="w-full bg-primary text-background px-8 py-4 rounded-2xl text-lg font-bold hover:bg-secondary transition-all duration-300 transform hover:scale-[1.02] shadow-2xl shadow-primary/25 hover:shadow-primary/40 flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed">
            <svg x-show="!isSubmitting" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            <svg x-show="isSubmitting" x-cloak class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim Permintaan Custom'"></span>
        </button>
    </form>
</div>

<script>
function customForm() {
    return {
        selectedFiles: [],
        isSubmitting: false,

        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                // Check file size (5MB limit)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File terlalu besar. Maksimal 5MB.');
                    return;
                }

                // Create preview
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.selectedFiles.push({
                        file: file,
                        name: file.name,
                        preview: e.target.result
                    });
                };
                reader.readAsDataURL(file);
            }
        },

        removeFile(index) {
            this.selectedFiles.splice(index, 1);
        },

        submitForm() {
            if (this.selectedFiles.length === 0) {
                alert('Silakan upload minimal satu foto referensi.');
                return;
            }

            this.isSubmitting = true;

            // The form will submit normally to the server
            // Alpine.js will handle the reactive state
        }
    }
}
</script>