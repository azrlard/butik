// Global variables for dynamic data
let categories = [];
let products = [];
let cart = [];
let currentPage = 'home';
let filteredProducts = [];

// Load data from API
async function loadDataFromAPI() {
    try {
        // Load categories
        const categoriesResponse = await fetch('/api/categories');
        categories = await categoriesResponse.json();

        // Icons and colors are now stored in the database
        // No need for manual mapping anymore

        // Load products
        const productsResponse = await fetch('/api/products');
        products = await productsResponse.json();

        // Transform product data for frontend compatibility
        products = products.map(product => ({
            ...product,
            kategori: product.category?.nama_kategori.toLowerCase() || 'unknown',
            rating: 4.5, // Default rating since not in DB
            terjual: Math.floor(Math.random() * 100) + 10 // Random sales count
        }));

        filteredProducts = [...products];

        // Load filter options after data is loaded
        loadCategoryFilter();
        loadTypeFilter();

    } catch (error) {
        console.error('Error loading data from API:', error);
        // Fallback to sample data if API fails
        loadFallbackData();
    }
}

function loadFallbackData() {
    categories = [
        { id: 1, nama_kategori: 'Pakaian', deskripsi: 'Koleksi pakaian trendy dan elegan untuk berbagai acara', icon: '👗', color: 'from-pink-400 to-pink-600' },
        { id: 2, nama_kategori: 'Aksesoris', deskripsi: 'Aksesoris cantik untuk mempercantik outfit harian Anda', icon: '💍', color: 'from-yellow-400 to-yellow-600' },
        { id: 3, nama_kategori: 'Elektronik', deskripsi: 'Elektronik berkualitas tinggi untuk kebutuhan modern', icon: '📱', color: 'from-green-400 to-green-600' }
    ];

    products = [
        { id: 1, nama_produk: 'Dress Elegant Premium', deskripsi: 'Dress elegant dengan bahan premium, cocok untuk acara formal dan semi-formal. Tersedia dalam berbagai ukuran.', harga: 299000, stok: 15, foto: '👗', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.8, terjual: 120 },
        { id: 2, nama_produk: 'Tas Kulit Asli Premium', deskripsi: 'Tas kulit asli dengan desain minimalis dan elegan. Dilengkapi dengan kompartemen yang fungsional.', harga: 450000, stok: 8, foto: '👜', tipe_produk: 'ready', kategori: 'tas', rating: 4.9, terjual: 85 },
        { id: 3, nama_produk: 'Kalung Emas Putih', deskripsi: 'Kalung emas putih dengan desain modern dan elegan. Cocok untuk acara formal maupun kasual.', harga: 750000, stok: 5, foto: '💍', tipe_produk: 'ready', kategori: 'aksesoris', rating: 4.7, terjual: 45 },
        { id: 4, nama_produk: 'Blazer Formal Wanita', deskripsi: 'Blazer formal dengan potongan yang sempurna untuk wanita karir. Bahan berkualitas tinggi dan nyaman digunakan.', harga: 380000, stok: 12, foto: '🧥', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.6, terjual: 95 },
        { id: 5, nama_produk: 'Sepatu Heels Elegant', deskripsi: 'Sepatu heels dengan desain elegant dan nyaman untuk digunakan seharian. Tersedia dalam berbagai warna.', harga: 320000, stok: 20, foto: '👠', tipe_produk: 'ready', kategori: 'sepatu', rating: 4.5, terjual: 150 },
        { id: 6, nama_produk: 'Kemeja Silk Premium', deskripsi: 'Kemeja silk premium dengan kualitas terbaik. Lembut, nyaman, dan memberikan kesan mewah.', harga: 250000, stok: 18, foto: '👔', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.8, terjual: 200 },
        { id: 7, nama_produk: 'Clutch Evening Bag', deskripsi: 'Clutch bag elegant untuk acara malam. Desain minimalis dengan detail yang mewah.', harga: 180000, stok: 10, foto: '👛', tipe_produk: 'ready', kategori: 'tas', rating: 4.4, terjual: 75 },
        { id: 8, nama_produk: 'Anting Berlian Asli', deskripsi: 'Anting berlian asli dengan sertifikat. Investasi perhiasan yang bernilai tinggi.', harga: 890000, stok: 3, foto: '💎', tipe_produk: 'ready', kategori: 'aksesoris', rating: 4.9, terjual: 25 },
        { id: 9, nama_produk: 'Custom Wedding Dress', deskripsi: 'Gaun pengantin custom sesuai dengan desain dan ukuran Anda. Dibuat oleh designer berpengalaman.', harga: 2500000, stok: 0, foto: '👰', tipe_produk: 'custom', kategori: 'pakaian', rating: 5.0, terjual: 15 },
        { id: 10, nama_produk: 'Custom Leather Jacket', deskripsi: 'Jaket kulit custom dengan desain sesuai keinginan Anda. Menggunakan kulit berkualitas tinggi.', harga: 1200000, stok: 0, foto: '🧥', tipe_produk: 'custom', kategori: 'pakaian', rating: 4.9, terjual: 30 },
        { id: 11, nama_produk: 'Rok Midi Flare', deskripsi: 'Rok midi dengan model flare yang feminim dan elegan. Cocok untuk berbagai acara.', harga: 220000, stok: 25, foto: '👗', tipe_produk: 'ready', kategori: 'pakaian', rating: 4.6, terjual: 180 },
        { id: 12, nama_produk: 'Backpack Leather Premium', deskripsi: 'Backpack kulit premium dengan desain modern dan fungsional. Cocok untuk traveling dan aktivitas sehari-hari.', harga: 520000, stok: 6, foto: '🎒', tipe_produk: 'ready', kategori: 'tas', rating: 4.7, terjual: 60 }
    ];

    filteredProducts = [...products];
}