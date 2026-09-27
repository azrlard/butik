<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\CustomRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pembayaran;
use App\Models\Pengiriman;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks for clean seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Pengiriman::truncate();
        Pembayaran::truncate();
        OrderItem::truncate();
        Order::truncate();
        CustomRequest::truncate();
        ProductVariant::truncate();
        Product::truncate();
        Category::truncate();
        User::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. SEED USERS
        $admin = User::create([
            'name' => 'Admin Ozzy',
            'email' => 'admin@butik.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $manajer = User::create([
            'name' => 'Manajer Butik',
            'email' => 'manajer@butik.com',
            'password' => Hash::make('manajer123'),
            'role' => 'manajer',
        ]);

        $customers = [
            User::create([
                'name' => 'Siti Rahmadani',
                'email' => 'siti@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'customer',
            ]),
            User::create([
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'customer',
            ]),
            User::create([
                'name' => 'Amanda Wijaya',
                'email' => 'amanda@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'customer',
            ]),
            User::create([
                'name' => 'Nadya Puspita',
                'email' => 'nadya@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'customer',
            ]),
            User::create([
                'name' => 'Reza Fahlevi',
                'email' => 'reza@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'customer',
            ]),
        ];

        // 2. SEED CATEGORIES (Sesuai jenis pakaian sebenarnya)
        $catKaos = Category::create([
            'nama_kategori' => 'Kaos & T-Shirt',
            'deskripsi' => 'Koleksi kaos polos cotton combed premium, heavyweight t-shirt, dan streetwear graphic tee adem dan nyaman.',
        ]);

        $catBatik = Category::create([
            'nama_kategori' => 'Batik Nusantara',
            'deskripsi' => 'Koleksi kemeja batik pria, tunik, dan dress batik wanita motif klasik Parang, Megamendung hingga modern kontemporer.',
        ]);

        $catGamis = Category::create([
            'nama_kategori' => 'Gamis & Gaun',
            'deskripsi' => 'Koleksi gamis silk sutra muslimah, abaya eksklusif, dan gaun pesta maxi dress elegan untuk acara formal.',
        ]);

        $catKebaya = Category::create([
            'nama_kategori' => 'Kebaya Modern',
            'deskripsi' => 'Kebaya wisuda, kebaya brokat modern, dan busana adat eksklusif dengan bordir dan payet mewah.',
        ]);

        $catJas = Category::create([
            'nama_kategori' => 'Jas & Setelan Formal',
            'deskripsi' => 'Setelan jas pria formal 3-piece, blazer eksekutif, dan pakaian resmi berpotongan slim-fit presisi.',
        ]);

        $catKemeja = Category::create([
            'nama_kategori' => 'Kemeja & Pakaian Kerja',
            'deskripsi' => 'Kemeja kerja formal pria, kemeja flanel kotak-kotak kasual, dan kemeja workwear tactical.',
        ]);

        $catCardigan = Category::create([
            'nama_kategori' => 'Cardigan & Knitwear',
            'deskripsi' => 'Koleksi knit cardigan rajut kancing, sweater rajut v-neck korea, dan pakaian rajut lembut hangat.',
        ]);

        // 3. SEED PRODUCTS (Data dan Foto 100% Sesuai)
        
        // --- KAOS & T-SHIRT ---
        $pKaos1 = Product::create([
            'category_id' => $catKaos->id,
            'nama_produk' => 'Kaos Polos Cotton Combed Hijau Emerald',
            'deskripsi' => 'Kaos polos leher bulat (crewneck) warna hijau emerald cerah. Terbuat dari 100% katun combed 24s yang halus, lembut, menyerap keringat, dan tidak panas.',
            'harga' => 89000,
            'stok' => 50,
            'foto' => 'products/kaos_polos_hijau.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pKaos2 = Product::create([
            'category_id' => $catKaos->id,
            'nama_produk' => 'Kaos Polos Heavyweight Dark Navy',
            'deskripsi' => 'Kaos polos warna biru navy pekat berbahan katun combed 20s tebal bertekstur kokoh. Jahitan rantai rapi pada pundak dan kerah rib elastis tahan lama.',
            'harga' => 95000,
            'stok' => 45,
            'foto' => 'products/kaos_polos_navy.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pKaos3 = Product::create([
            'category_id' => $catKaos->id,
            'nama_produk' => 'Kaos Polos Regular Fit Hitam Jet Black',
            'deskripsi' => 'Kaos oblong hitam pekat dengan potongan regular fit yang pas di badan. Pilihan utama untuk gaya santai minimalis maupun dalaman kemeja.',
            'harga' => 89000,
            'stok' => 60,
            'foto' => 'products/kaos_polos_hitam.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pKaos4 = Product::create([
            'category_id' => $catKaos->id,
            'nama_produk' => 'Kaos Distro Oversize Graphic Star Flame Putih',
            'deskripsi' => 'T-Shirt distro streetwear warna putih dengan sablon plastisol grafis bintang api pink aesthetic di bagian punggung. Potongan kekinian drop shoulder.',
            'harga' => 135000,
            'stok' => 30,
            'foto' => 'products/kaos_distro_putih.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- BATIK NUSANTARA ---
        $pBatik1 = Product::create([
            'category_id' => $catBatik->id,
            'nama_produk' => 'Kemeja Batik Pria Lengan Panjang Motif Parang Klasik',
            'deskripsi' => 'Kemeja batik pria lengan panjang dengan motif Parang Barong klasik berpadu floral cokelat keemasan. Dilengkapi furing katun arrow adem dan saku paspol rapi.',
            'harga' => 285000,
            'stok' => 35,
            'foto' => 'products/batik_pria_parang.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pBatik2 = Product::create([
            'category_id' => $catBatik->id,
            'nama_produk' => 'Dress Batik Modern Wanita Motif Floral Navy Gold',
            'deskripsi' => 'Gaun terusan batik wanita modern dengan motif kombinasi burung phoenix dan bunga nusantara warna navy-emas. Siluet A-line anggun dengan ikat pinggang senada.',
            'harga' => 345000,
            'stok' => 25,
            'foto' => 'products/batik_wanita_dress.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pBatik3 = Product::create([
            'category_id' => $catBatik->id,
            'nama_produk' => 'Kemeja Batik Pria Lengan Pendek Motif Megamendung Navy',
            'deskripsi' => 'Kemeja batik casual pria lengan pendek motif Mega Mendung Cirebon bernuansa navy dan cokelat susu. Model kerah terbuka retro santai untuk hangout atau semi-formal.',
            'harga' => 225000,
            'stok' => 40,
            'foto' => 'products/batik_pendek_pria.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- GAMIS & GAUN ---
        $pGamis1 = Product::create([
            'category_id' => $catGamis->id,
            'nama_produk' => 'Gamis Silk Sutra Premium Sage Green Muslimah',
            'deskripsi' => 'Gamis pesta muslimah berbahan sutra silk premium warna sage green lembut berkilau elegan. Dipercantik bordir payet mutiara di dada dan ujung rok serta pashmina senada.',
            'harga' => 395000,
            'stok' => 28,
            'foto' => 'products/gamis_silk_sage.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pGaun1 = Product::create([
            'category_id' => $catGamis->id,
            'nama_produk' => 'Gaun Pesta Maxi Dress Satin Merah Elegan',
            'deskripsi' => 'Gaun pesta panjang berbahan satin silk warna merah merona dengan potongan A-line dramatis. Menampilkan siluet ramping dan glamor untuk acara pesta malam & prom.',
            'harga' => 450000,
            'stok' => 20,
            'foto' => 'products/gaun_pesta_merah.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- KEBAYA MODERN ---
        $pKebaya1 = Product::create([
            'category_id' => $catKebaya->id,
            'nama_produk' => 'Kebaya Wisuda Brokat Modern Sage Green & Rok Batik',
            'deskripsi' => 'Setelan kebaya wisuda brokat payet mutiara warna sage green anggun dipadukan dengan rok jarik batik prada wiru. Jahitan rapi butik dan fitting proporsional.',
            'harga' => 550000,
            'stok' => 22,
            'foto' => 'products/kebaya_wisuda_modern.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- JAS & SETELAN FORMAL ---
        $pJas1 = Product::create([
            'category_id' => $catJas->id,
            'nama_produk' => 'Setelan Jas Pria 3-Piece Plaid Kotak Biru',
            'deskripsi' => 'Setelan jas formal pria 3-piece lengkap (jas blazer motif kotak plaid biru, rompi vest formal, dan celana bahan). Menggunakan bahan wool blend impor.',
            'harga' => 850000,
            'stok' => 18,
            'foto' => 'products/jas_setelan_kotak.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pJas2 = Product::create([
            'category_id' => $catJas->id,
            'nama_produk' => 'Jas Pria Slim Fit Formal Executive Navy',
            'deskripsi' => 'Jas blazer pria formal warna biru navy gelap dengan potongan slim-fit yang membentuk postur gagah. Cocok untuk acara pernikahan, seminar, dan eksekutif kantor.',
            'harga' => 590000,
            'stok' => 25,
            'foto' => 'products/jas_navy_formal.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- KEMEJA & PAKAIAN KERJA ---
        $pKemeja1 = Product::create([
            'category_id' => $catKemeja->id,
            'nama_produk' => 'Kemeja Formal Kerja Putih Lengan Panjang & Dasi',
            'deskripsi' => 'Kemeja kantor pria warna putih bersih berbahan katun oxford premium anti lecek, dipadukan dasi motif polkadot elegan untuk penampilan profesional.',
            'harga' => 245000,
            'stok' => 35,
            'foto' => 'products/kemeja_formal_putih.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pKemeja2 = Product::create([
            'category_id' => $catKemeja->id,
            'nama_produk' => 'Kemeja Flanel Kotak-Kotak Lengan Panjang Mustard Navy',
            'deskripsi' => 'Kemeja flanel kasual pria motif tartan kotak kombinasi kuning mustard dan navy. Bahan flanel tebal berbulu halus yang hangat dan nyaman untuk outer kasual.',
            'harga' => 215000,
            'stok' => 40,
            'foto' => 'products/kemeja_flanel_mustard.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pKemeja3 = Product::create([
            'category_id' => $catKemeja->id,
            'nama_produk' => 'Kemeja Workwear Carhartt Tactical Grey Lengan Pendek',
            'deskripsi' => 'Kemeja casual workwear utilitarian warna abu charcoal gelap dengan saku ganda di dada berlogo patch. Kuat, kokoh, dan tahan gesekan untuk aktivitas outdoor.',
            'harga' => 320000,
            'stok' => 25,
            'foto' => 'products/kemeja_workwear_carhartt.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pKemeja4 = Product::create([
            'category_id' => $catKemeja->id,
            'nama_produk' => 'Kemeja Vintage Military U.S. Air Force Tactical Olive',
            'deskripsi' => 'Kemeja vintage bernuansa militer taktis warna hijau zaitun (olive green) dengan emblem bordir otentik U.S. Air Force. Unik dan bergaya retro military.',
            'harga' => 275000,
            'stok' => 20,
            'foto' => 'products/kemeja_vintage_military.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- CARDIGAN & KNITWEAR ---
        $pCardigan1 = Product::create([
            'category_id' => $catCardigan->id,
            'nama_produk' => 'Cardigan Rajut Wool Kancing Hijau Emerald Alex Mill',
            'deskripsi' => 'Cardigan rajutan wol tebal bertekstur rib dengan kancing kontras depan warna hijau emerald. Hangat, lembut di kulit, dan cocok dipadukan dengan kaos maupun kemeja.',
            'harga' => 265000,
            'stok' => 30,
            'foto' => 'products/cardigan_rajut_hijau.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pCardigan2 = Product::create([
            'category_id' => $catCardigan->id,
            'nama_produk' => 'Cardigan Rajut V-Neck Baby Blue Pastel',
            'deskripsi' => 'Cardigan rajut santai potongan kerah V-neck warna biru muda pastel lembut. Desain minimalis korea yang manis untuk cuaca ber-AC atau nongkrong sore.',
            'harga' => 250000,
            'stok' => 28,
            'foto' => 'products/cardigan_rajut_biru.jpg',
            'tipe_produk' => 'ready',
        ]);

        $pCardigan3 = Product::create([
            'category_id' => $catCardigan->id,
            'nama_produk' => 'Cardigan Knit Chunky Cream Ivory Broken White',
            'deskripsi' => 'Cardigan rajut tebal berpotongan loose chunky knit warna broken white ivory. Tali rajutan halus memberikan estetika estetik dan kenyamanan maksimal.',
            'harga' => 270000,
            'stok' => 25,
            'foto' => 'products/cardigan_rajut_cream.jpg',
            'tipe_produk' => 'ready',
        ]);

        // --- CUSTOM TAILORING PRODUCTS ---
        $pCustomKebaya = Product::create([
            'category_id' => $catKebaya->id,
            'nama_produk' => 'Jasa Jahit Custom Kebaya Wisuda & Pernikahan',
            'deskripsi' => 'Layanan jahit kustom kebaya modern, kutubaru, atau brokat wisuda sesuai ukuran badan dan pilihan kain pelanggan. Dilengkapi fitting presisi.',
            'harga' => 550000,
            'stok' => 0,
            'foto' => 'products/kebaya_wisuda_modern.jpg',
            'tipe_produk' => 'custom',
        ]);

        $pCustomJas = Product::create([
            'category_id' => $catJas->id,
            'nama_produk' => 'Jasa Jahit Custom Setelan Jas Pengantin Pria',
            'deskripsi' => 'Layanan pembuatan setelan jas pria custom bespoke dengan bahan wol semi-wool impor Italia, furing sutra, dan busa pundak profesional.',
            'harga' => 1250000,
            'stok' => 0,
            'foto' => 'products/jas_navy_formal.jpg',
            'tipe_produk' => 'custom',
        ]);

        $pCustomGamis = Product::create([
            'category_id' => $catGamis->id,
            'nama_produk' => 'Jasa Jahit Custom Gamis Sutra Silk & Gaun Pesta',
            'deskripsi' => 'Layanan jahit custom gaun muslimah atau gamis silk pesta sesuai model impian dengan detail payet swarovski dan bordir handmade.',
            'harga' => 750000,
            'stok' => 0,
            'foto' => 'products/gamis_silk_sage.jpg',
            'tipe_produk' => 'custom',
        ]);

        $pCustomBatik = Product::create([
            'category_id' => $catBatik->id,
            'nama_produk' => 'Jasa Jahit Custom Kemeja Batik Tulis Sutra',
            'deskripsi' => 'Layanan jahit eksklusif kemeja batik tulis pria/wanita dengan penyesuaian motif sambung simetris sempurna dan furing katun arrow.',
            'harga' => 450000,
            'stok' => 0,
            'foto' => 'products/batik_pria_parang.jpg',
            'tipe_produk' => 'custom',
        ]);

        // 4. SEED PRODUCT VARIANTS
        $allReadyProducts = [
            $pKaos1, $pKaos2, $pKaos3, $pKaos4,
            $pBatik1, $pBatik2, $pBatik3,
            $pGamis1, $pGaun1,
            $pKebaya1,
            $pJas1, $pJas2,
            $pKemeja1, $pKemeja2, $pKemeja3, $pKemeja4,
            $pCardigan1, $pCardigan2, $pCardigan3
        ];
        
        $variantsMap = [];

        foreach ($allReadyProducts as $prod) {
            $sizes = [
                ['size' => 'S', 'stock' => 12, 'price' => $prod->harga],
                ['size' => 'M', 'stock' => 18, 'price' => $prod->harga],
                ['size' => 'L', 'stock' => 15, 'price' => $prod->harga + 10000],
                ['size' => 'XL', 'stock' => 10, 'price' => $prod->harga + 20000],
            ];

            foreach ($sizes as $s) {
                $variant = ProductVariant::create([
                    'product_id' => $prod->id,
                    'size' => $s['size'],
                    'stock' => $s['stock'],
                    'price_adjustment' => $s['price'],
                ]);
                $variantsMap[$prod->id][$s['size']] = $variant;
            }
        }

        // 5. SEED CUSTOM REQUESTS
        $cr1 = CustomRequest::create([
            'user_id' => $customers[0]->id, // Siti
            'produk_id' => $pCustomKebaya->id,
            'customer_name' => 'Siti Rahmadani',
            'customer_email' => 'siti@gmail.com',
            'customer_phone' => '081234567890',
            'product_category' => 'Kebaya Modern',
            'alamat' => 'Jl. Boulevard Gading Serpong No. 18, Tangerang',
            'keterangan' => 'Ukuran: Lingkar Dada 92cm, Lingkar Pinggang 74cm, Panjang Baju 70cm, Panjang Lengan 54cm. Ingin bahan brokat mutiara warna sage green pastel seperti foto referensi.',
            'status' => 'in_progress',
            'harga_estimasi' => 550000,
            'foto_referensi' => 'products/kebaya_wisuda_modern.jpg',
        ]);

        $cr2 = CustomRequest::create([
            'user_id' => $customers[1]->id, // Budi
            'produk_id' => $pCustomJas->id,
            'customer_name' => 'Budi Santoso',
            'customer_email' => 'budi@gmail.com',
            'customer_phone' => '082198765432',
            'product_category' => 'Jas & Setelan Formal',
            'alamat' => 'Jl. Tebet Barat Dalam Raya No. 45, Jakarta Selatan',
            'keterangan' => 'Ukuran: Lingkar Dada 104cm, Panjang Jas 76cm, Panjang Celana 100cm, Pinggang 88cm. Warna navy formal slim-fit bahan semi-wool.',
            'status' => 'approved',
            'harga_estimasi' => 1250000,
            'foto_referensi' => 'products/jas_navy_formal.jpg',
        ]);

        $cr3 = CustomRequest::create([
            'user_id' => $customers[2]->id, // Amanda
            'produk_id' => $pCustomGamis->id,
            'customer_name' => 'Amanda Wijaya',
            'customer_email' => 'amanda@gmail.com',
            'customer_phone' => '085612348765',
            'product_category' => 'Gamis & Gaun',
            'alamat' => 'Jl. Dago Asri No. 12, Bandung',
            'keterangan' => 'Ukuran: LD 88cm, LP 70cm, Panjang Gamis 138cm. Bahan silk warna sage green dengan bordir elegan.',
            'status' => 'done',
            'harga_estimasi' => 750000,
            'foto_referensi' => 'products/gamis_silk_sage.jpg',
        ]);

        $cr4 = CustomRequest::create([
            'user_id' => $customers[4]->id, // Reza
            'produk_id' => $pCustomBatik->id,
            'customer_name' => 'Reza Fahlevi',
            'customer_email' => 'reza@gmail.com',
            'customer_phone' => '081399887766',
            'product_category' => 'Batik Nusantara',
            'alamat' => 'Jl. Margonda Raya No. 88, Depok',
            'keterangan' => 'Kemeja batik pria motif parang klasik lengan panjang, furing adem, ukuran LD 100cm panjang 74cm.',
            'status' => 'pending',
            'harga_estimasi' => 450000,
            'foto_referensi' => 'products/batik_pria_parang.jpg',
        ]);

        // 6. SEED ORDERS & ORDER ITEMS & PEMBAYARAN & PENGIRIMAN
        
        // Order 1: Siti (Batik Dress M - Paid & Shipped)
        $order1 = Order::create([
            'user_id' => $customers[0]->id,
            'total_harga' => 345000,
            'status' => 'shipped',
            'metode_pembayaran' => 'Midtrans QRIS',
            'alamat_pengiriman' => 'Jl. Boulevard Gading Serpong No. 18, Tangerang',
            'customer_name' => 'Siti Rahmadani',
            'customer_email' => 'siti@gmail.com',
            'customer_phone' => '081234567890',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $pBatik2->id,
            'variant_id' => $variantsMap[$pBatik2->id]['M']->id,
            'jumlah' => 1,
            'harga_satuan' => 345000,
            'subtotal' => 345000,
            'harga' => 345000,
        ]);

        Pembayaran::create([
            'order_id' => $order1->id,
            'metode_pembayaran' => 'Midtrans QRIS',
            'jumlah_bayar' => 345000,
            'status_pembayaran' => 'paid',
            'tanggal_bayar' => now()->subDays(2),
        ]);

        Pengiriman::create([
            'order_id' => $order1->id,
            'nama_penerima' => 'Siti Rahmadani',
            'alamat_pengiriman' => 'Jl. Boulevard Gading Serpong No. 18, Tangerang',
            'no_hp' => '081234567890',
            'kurir' => 'JNE REG',
            'no_resi' => 'JNE-882199341',
            'status_pengiriman' => 'dikirim',
            'tanggal_kirim' => now()->subDay(),
        ]);

        // Order 2: Budi (Kaos Polos Navy L + Kemeja Flanel M - Completed)
        $subtotalKaos = 105000; // Kaos Navy L (+10k)
        $subtotalFlanel = 215000; // Flanel M
        $totalOrder2 = $subtotalKaos + $subtotalFlanel;

        $order2 = Order::create([
            'user_id' => $customers[1]->id,
            'total_harga' => $totalOrder2,
            'status' => 'completed',
            'metode_pembayaran' => 'BCA Virtual Account',
            'alamat_pengiriman' => 'Jl. Tebet Barat Dalam Raya No. 45, Jakarta Selatan',
            'customer_name' => 'Budi Santoso',
            'customer_email' => 'budi@gmail.com',
            'customer_phone' => '082198765432',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $pKaos2->id,
            'variant_id' => $variantsMap[$pKaos2->id]['L']->id,
            'jumlah' => 1,
            'harga_satuan' => $subtotalKaos,
            'subtotal' => $subtotalKaos,
            'harga' => $subtotalKaos,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $pKemeja2->id,
            'variant_id' => $variantsMap[$pKemeja2->id]['M']->id,
            'jumlah' => 1,
            'harga_satuan' => $subtotalFlanel,
            'subtotal' => $subtotalFlanel,
            'harga' => $subtotalFlanel,
        ]);

        Pembayaran::create([
            'order_id' => $order2->id,
            'metode_pembayaran' => 'BCA Virtual Account',
            'jumlah_bayar' => $totalOrder2,
            'status_pembayaran' => 'paid',
            'tanggal_bayar' => now()->subDays(5),
        ]);

        Pengiriman::create([
            'order_id' => $order2->id,
            'nama_penerima' => 'Budi Santoso',
            'alamat_pengiriman' => 'Jl. Tebet Barat Dalam Raya No. 45, Jakarta Selatan',
            'no_hp' => '082198765432',
            'kurir' => 'SiCepat BEST',
            'no_resi' => 'SCP-992182741',
            'status_pengiriman' => 'sampai',
            'tanggal_kirim' => now()->subDays(4),
            'tanggal_terima' => now()->subDays(2),
        ]);

        // Order 3: Amanda (Gamis Silk M - Completed)
        $order3 = Order::create([
            'user_id' => $customers[2]->id,
            'total_harga' => 395000,
            'status' => 'completed',
            'metode_pembayaran' => 'Midtrans GoPay',
            'alamat_pengiriman' => 'Jl. Dago Asri No. 12, Bandung',
            'customer_name' => 'Amanda Wijaya',
            'customer_email' => 'amanda@gmail.com',
            'customer_phone' => '085612348765',
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => $pGamis1->id,
            'variant_id' => $variantsMap[$pGamis1->id]['M']->id,
            'jumlah' => 1,
            'harga_satuan' => 395000,
            'subtotal' => 395000,
            'harga' => 395000,
        ]);

        Pembayaran::create([
            'order_id' => $order3->id,
            'metode_pembayaran' => 'Midtrans GoPay',
            'jumlah_bayar' => 395000,
            'status_pembayaran' => 'paid',
            'tanggal_bayar' => now()->subDays(3),
        ]);

        Pengiriman::create([
            'order_id' => $order3->id,
            'nama_penerima' => 'Amanda Wijaya',
            'alamat_pengiriman' => 'Jl. Dago Asri No. 12, Bandung',
            'no_hp' => '085612348765',
            'kurir' => 'J&T Express',
            'no_resi' => 'JNT-771122889',
            'status_pengiriman' => 'sampai',
            'tanggal_kirim' => now()->subDays(3),
            'tanggal_terima' => now()->subDay(),
        ]);

        // Order 4: Reza (Kemeja Batik Pria Parang M - Pending Payment)
        $order4 = Order::create([
            'user_id' => $customers[4]->id,
            'total_harga' => 285000,
            'status' => 'pending',
            'metode_pembayaran' => 'Midtrans QRIS',
            'alamat_pengiriman' => 'Jl. Margonda Raya No. 88, Depok',
            'customer_name' => 'Reza Fahlevi',
            'customer_email' => 'reza@gmail.com',
            'customer_phone' => '081399887766',
        ]);

        OrderItem::create([
            'order_id' => $order4->id,
            'product_id' => $pBatik1->id,
            'variant_id' => $variantsMap[$pBatik1->id]['M']->id,
            'jumlah' => 1,
            'harga_satuan' => 285000,
            'subtotal' => 285000,
            'harga' => 285000,
        ]);

        Pembayaran::create([
            'order_id' => $order4->id,
            'metode_pembayaran' => 'Midtrans QRIS',
            'jumlah_bayar' => 285000,
            'status_pembayaran' => 'pending',
            'tanggal_bayar' => null,
        ]);

        // Order 5: Custom Request Order Done (Amanda - Custom Gamis)
        $order5 = Order::create([
            'user_id' => $customers[2]->id,
            'total_harga' => 750000,
            'status' => 'paid',
            'metode_pembayaran' => 'Mandiri Virtual Account',
            'alamat_pengiriman' => 'Jl. Dago Asri No. 12, Bandung',
            'customer_name' => 'Amanda Wijaya',
            'customer_email' => 'amanda@gmail.com',
            'customer_phone' => '085612348765',
        ]);

        OrderItem::create([
            'order_id' => $order5->id,
            'product_id' => $pCustomGamis->id,
            'custom_request_id' => $cr3->id,
            'jumlah' => 1,
            'harga_satuan' => 750000,
            'subtotal' => 750000,
            'harga' => 750000,
        ]);

        Pembayaran::create([
            'order_id' => $order5->id,
            'metode_pembayaran' => 'Mandiri Virtual Account',
            'jumlah_bayar' => 750000,
            'status_pembayaran' => 'paid',
            'tanggal_bayar' => now()->subDay(),
        ]);
    }
}
