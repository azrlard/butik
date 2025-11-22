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

    <form x-data="customForm()" @submit="return submitForm()" method="POST" action="/custom-request" enctype="multipart/form-data" class="p-8">
        @csrf
        <!-- Product Information -->
        <div class="mb-8">
            <h4 class="text-lg font-semibold text-text mb-4 flex items-center">
                <span class="w-8 h-8 bg-secondary text-background rounded-full flex items-center justify-center mr-3 text-sm font-bold">1</span>
                Informasi Produk
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group">
                    <label for="product-category" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Kategori Produk</label>
                    <div class="relative">
                        <select id="product-category" name="product-category" required
                                class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background appearance-none">
                            <option value="">Pilih kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->nama_kategori }}">{{ $category->nama_kategori }}</option>
                            @endforeach
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
                <div class="group">
                    <label for="ukuran" class="block text-sm font-semibold text-text mb-2 group-focus-within:text-primary transition-colors">Ukuran (Opsional)</label>
                    <div class="relative">
                        <input type="text" id="ukuran" name="ukuran" placeholder="Contoh: S, M, L, XL atau 30x40 cm"
                               class="w-full px-4 py-3 pl-12 border border-secondary rounded-xl focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 bg-accent focus:bg-background">
                        <div class="absolute left-3 top-3.5 text-text group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
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
                return false;
            }

            // Check if user is logged in
            @if(!auth()->check())
                // Redirect to login page if not logged in
                window.location.href = '/login';
                return false;
            @endif

            this.isSubmitting = true;

            return true;
        }
    }
}
</script>