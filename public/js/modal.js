// Product detail functions
function showProductDetail(productId) {
    const product = products.find(p => p.id === productId);
    if (!product) return;

    const isCustom = product.tipe_produk === 'custom';
    const stockText = isCustom ? 'Custom Order Available' : `Stok tersedia: ${product.stok} pcs`;
    const stockClass = isCustom ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800';

    document.getElementById('modal-content').innerHTML = `
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center mb-4">
                    <span class="text-8xl">${product.foto}</span>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    ${Array(4).fill().map(() => `
                        <div class="bg-gray-100 rounded-lg h-20 flex items-center justify-center cursor-pointer hover:bg-gray-200 transition-colors">
                            <span class="text-2xl">${product.foto}</span>
                        </div>
                    `).join('')}
                </div>
            </div>
            <div class="space-y-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">${product.nama_produk}</h2>
                    <div class="flex items-center mb-4">
                        <span class="text-yellow-400 mr-1">⭐</span>
                        <span class="text-gray-600 mr-4">${product.rating} (${product.terjual} terjual)</span>
                        <span class="${stockClass} px-3 py-1 rounded-full text-sm font-medium">${isCustom ? 'Custom' : 'Ready Stock'}</span>
                    </div>
                    <p class="text-3xl font-bold text-indigo-600 mb-4">Rp ${product.harga.toLocaleString('id-ID')}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">${product.deskripsi}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600 mb-4">${stockText}</p>
                </div>

                ${!isCustom ? `
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Ukuran</h3>
                        <div class="flex space-x-2 mb-6">
                            <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">S</button>
                            <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">M</button>
                            <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">L</button>
                            <button class="border border-gray-300 px-4 py-2 rounded-lg hover:border-indigo-600 hover:text-indigo-600 transition-colors">XL</button>
                        </div>
                    </div>
                ` : ''}

                <div class="flex space-x-4">
                    <button onclick="addToCart(${product.id}); closeModal();" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition-colors">
                        ${isCustom ? 'Pesan Custom' : 'Tambah ke Keranjang'}
                    </button>
                    ${!isCustom ? `
                        <button class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                            Beli Sekarang
                        </button>
                    ` : `
                        <button onclick="navigateTo('custom'); closeModal();" class="flex-1 bg-yellow-400 text-gray-800 px-6 py-3 rounded-xl font-semibold hover:bg-yellow-300 transition-colors">
                            Custom Request
                        </button>
                    `}
                </div>
            </div>
        </div>
    `;

    // Load similar products
    const similarProducts = products.filter(p => p.kategori === product.kategori && p.id !== product.id).slice(0, 4);
    if (similarProducts.length > 0) {
        document.getElementById('modal-content').innerHTML += `
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Produk Serupa</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    ${similarProducts.map(p => `
                        <div class="bg-gray-50 rounded-lg p-4 text-center hover:bg-gray-100 transition-colors cursor-pointer" onclick="showProductDetail(${p.id})">
                            <div class="text-3xl mb-2">${p.foto}</div>
                            <h4 class="font-semibold text-sm text-gray-800 mb-1">${p.nama_produk}</h4>
                            <p class="text-indigo-600 font-bold text-sm">Rp ${p.harga.toLocaleString('id-ID')}</p>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    }

    document.getElementById('product-modal').classList.add('show');
}

function closeModal() {
    document.getElementById('product-modal').classList.remove('show');
}