<?php
session_start();
include 'includes/db.php';

// Debug: Cek koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

include 'includes/header.php';

// Ambil product_id dari URL jika ada
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;
$selectedProduct = null;

// Ambil semua data produk dari database
$productsData = [];
$queryProducts = "SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.kategori_id = k.id ORDER BY p.id DESC";
$resultProducts = mysqli_query($conn, $queryProducts);

// Debug: Cek query error
if (!$resultProducts) {
    die("Query error: " . mysqli_error($conn));
}

if ($resultProducts && mysqli_num_rows($resultProducts) > 0) {
    while ($row = mysqli_fetch_assoc($resultProducts)) {
        // Konversi harga ke range
        $price_range = 'medium';
        if ($row['harga'] < 150000) {
            $price_range = 'low';
        } elseif ($row['harga'] > 500000) {
            $price_range = 'high';
        }

        // Rating default jika tidak ada
        $rating = isset($row['rating']) && !empty($row['rating']) ? floatval($row['rating']) : 4.5;

        // Brand dan skin_type dengan fallback
        $brand = isset($row['brand']) && !empty($row['brand']) ? $row['brand'] : 'GlamUp';
        $skin_type = isset($row['skin_type']) && !empty($row['skin_type']) ? $row['skin_type'] : 'Semua Jenis Kulit';

        $productData = [
            'product_id' => $row['id'],
            'name' => $row['judul'],
            'category' => $row['nama_kategori'] ?? 'Kecantikan',
            'brand' => $brand,
            'skin_type' => $skin_type,
            'rating' => $rating,
            'price_range' => $price_range,
            'price' => $row['harga'],
            'description' => $row['deskripsi'] ?? 'Produk kecantikan berkualitas untuk Anda.',
            'link' => $row['link'] ?? '#',
            'gambar' => $row['gambar'] ?? ''
        ];

        $productsData[] = $productData;

        // Simpan produk yang dipilih jika ID cocok
        if ($productId && $row['id'] == $productId) {
            $selectedProduct = $productData;
        }
    }
} else {
    // Jika database kosong, gunakan data hardcoded sebagai fallback
    $productsData = [
        [
            'product_id' => 1,
            'name' => 'MEDICUBE PDRN Pink Vita Coated Sheet Mask',
            'category' => 'Masker Wajah',
            'brand' => 'Medicube',
            'skin_type' => 'Semua Jenis Kulit',
            'rating' => 4.8,
            'price_range' => 'medium',
            'price' => 200000,
            'description' => 'Masker wajah dengan teknologi PDRN dan Vita Coating untuk hidrasi maksimal dan perbaikan kulit. Cocok untuk semua jenis kulit.',
            'link' => 'https://shopee.co.id/-READY-MEDICUBE-PDRN-Pink-Vita-Coated-Sheet-Mask-1-Sheet-i.283856202.41403117504',
            'gambar' => ''
        ],
        [
            'product_id' => 2,
            'name' => 'Seven Little Fortunes Sample Lipstick Set',
            'category' => 'Lipstick',
            'brand' => 'Seven Little Fortunes',
            'skin_type' => 'Semua Jenis Kulit',
            'rating' => 4.5,
            'price_range' => 'low',
            'price' => 75000,
            'description' => 'Set lipstick matte dengan 7 warna berbeda yang tahan lama, cocok untuk semua kesempatan dan kulit.',
            'link' => 'https://shopee.co.id/Seven-Little-Fortunes-Sample-Lipstick-Lipstick-Matte-Kosmetik-MAC-DlOR-Matte-Lipstik-Gift-For-Girlfriend-7-sets-i.1488817965.42969584276',
            'gambar' => ''
        ],
        [
            'product_id' => 3,
            'name' => '5190 Eyeshadow Palette 20 Warna',
            'category' => 'Eyeshadow',
            'brand' => 'INDO KOSME',
            'skin_type' => 'Semua Jenis Kulit',
            'rating' => 4.7,
            'price_range' => 'low',
            'price' => 85000,
            'description' => 'Palette eyeshadow dengan 20 warna kombinasi matte dan shimmer yang sangat pigmented dan tahan lama.',
            'link' => 'https://shopee.co.id/5190-Eyeshadow-Palette-20-Warna-%E2%80%93-Matte-Shimmer-Tahan-Lama-Warna-Pigmented!-INDO-KOSME-i.1647802478.42173250595',
            'gambar' => ''
        ],
        [
            'product_id' => 4,
            'name' => '6-in-1 LS Skincare Bundle',
            'category' => 'Skincare Set',
            'brand' => 'LS Skincare',
            'skin_type' => 'Kulit Normal hingga Kering',
            'rating' => 4.6,
            'price_range' => 'medium',
            'price' => 250000,
            'description' => 'Paket lengkap skincare 6 produk untuk perawatan wajah sehari-hari yang membuat kulit glowing.',
            'link' => 'https://shopee.co.id/6-in-1-ls-skincre-rbn-cream-siang-malam-toner-facial-wash-serum-readgel-EKSTRA-BUNDLING-GLOWING-LS-SKINCARE-i.1404455366.51701649722',
            'gambar' => ''
        ]
    ];

    // Cari produk yang dipilih dari data hardcoded
    if ($productId) {
        foreach ($productsData as $product) {
            if ($product['product_id'] == $productId) {
                $selectedProduct = $product;
                break;
            }
        }
    }
}

// Jika ada product_id tapi produk tidak ditemukan
if ($productId && !$selectedProduct) {
    // Product not found, redirect
    header("Location: rekomendasi.php");
    exit;
}

// Fungsi untuk format harga
function formatPriceRange($range)
{
    switch ($range) {
        case 'low':
            return 'Rp 50rb - 150rb';
        case 'medium':
            return 'Rp 150rb - 500rb';
        case 'high':
            return 'Rp 500rb+';
        default:
            return 'Harga bervariasi';
    }
}

// Fungsi untuk render rating bintang
function renderStars($rating)
{
    $stars = '';
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5;

    for ($i = 0; $i < $fullStars; $i++) {
        $stars .= '<i class="fas fa-star"></i>';
    }
    if ($halfStar) {
        $stars .= '<i class="fas fa-star-half-alt"></i>';
    }
    $emptyStars = 5 - ceil($rating);
    for ($i = 0; $i < $emptyStars; $i++) {
        $stars .= '<i class="far fa-star"></i>';
    }
    return $stars;
}

// Fungsi untuk mendapatkan produk serupa
function getSimilarProducts($selectedProduct, $allProducts)
{
    $similarProducts = [];

    foreach ($allProducts as $product) {
        // Skip produk yang sama
        if ($product['product_id'] == $selectedProduct['product_id']) {
            continue;
        }

        $score = 0;

        // Beri skor berdasarkan kesamaan
        if ($product['category'] === $selectedProduct['category']) $score += 3;
        if ($product['brand'] === $selectedProduct['brand']) $score += 2;
        if ($product['skin_type'] === $selectedProduct['skin_type']) $score += 1;
        if ($product['price_range'] === $selectedProduct['price_range']) $score += 1;

        // Tambahkan semua produk ke rekomendasi (bahkan jika score = 0)
        $similarProducts[] = [
            'product' => $product,
            'score' => $score,
            'similarity' => $score > 0 ? min(100, 60 + ($score * 10)) : 50 // Minimal 50% similarity
        ];
    }

    // Urutkan berdasarkan skor tertinggi
    usort($similarProducts, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    // Ambil maksimal 9 rekomendasi
    return array_slice($similarProducts, 0, 9);
}

$recommendations = [];

// Cari produk rekomendasi jika ada produk yang dipilih
if ($selectedProduct) {
    $recommendations = getSimilarProducts($selectedProduct, $productsData);
}

// Debug: Tampilkan info jika tidak ada rekomendasi
if ($selectedProduct && count($recommendations) === 0) {
    error_log("No recommendations found for product ID: " . $selectedProduct['product_id']);
    error_log("Total products in database: " . count($productsData));
}
?>

<style>
    :root {
        --primary-pink: #ff69b4;
        --primary-dark: #d6336c;
        --secondary: #ff9a8b;
        --text-color: #4a4a4a;
        --text-light: #8a8a8a;
        --background: #fef6f9;
        --card-bg: #ffffff;
        --border: #f0e6ea;
        --shadow: 0 8px 30px rgba(231, 84, 128, 0.08);
    }

    .product-card {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        cursor: pointer;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #d1d8e0;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(231, 84, 128, 0.15);
        border-color: var(--primary-pink);
    }

    .product-name {
        font-weight: 600;
        color: var(--text-color);
        font-size: 1.1rem;
        margin-bottom: 10px;
        line-height: 1.4;
        min-height: 50px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-brand {
        color: var(--primary-pink);
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .product-category {
        color: var(--text-light);
        font-size: 0.85rem;
        margin-bottom: 12px;
        background: #f8f9fa;
        padding: 4px 10px;
        border-radius: 12px;
        display: inline-block;
    }

    .product-rating {
        color: #ffc107;
        margin: 12px 0;
        font-size: 0.9rem;
    }

    .product-price {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        color: #2e7d32;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
        margin-top: auto;
        margin-bottom: 15px;
        font-size: 0.9rem;
        box-shadow: 0 2px 8px rgba(46, 125, 50, 0.1);
    }

    .product-info-section {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-actions {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .similarity-badge {
        background: linear-gradient(135deg, #ff69b4 0%, #ff9a8b 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(255, 105, 180, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-header-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
        gap: 10px;
    }

    .card-header-section .product-name {
        flex: 1;
        margin: 0;
    }

    .filter-section {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
    }

    .filter-btn {
        background: white;
        border: 2px solid var(--primary-pink);
        color: var(--primary-pink);
        padding: 10px 20px;
        border-radius: 25px;
        margin: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--primary-pink);
        color: white;
    }

    .search-box {
        padding: 15px 20px;
        border: 2px solid var(--border);
        border-radius: 25px;
        width: 100%;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .search-box:focus {
        outline: none;
        border-color: var(--primary-pink);
    }

    .selected-product-section {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
        border-top: 5px solid var(--primary-pink);
    }

    .btn-shopee {
        background: linear-gradient(135deg, #ff69b4 0%, #ff9a8b 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-shopee:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 105, 180, 0.3);
    }
</style>

<!-- Header Start -->
<div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h1 class="text-white display-3 mt-lg-5">Rekomendasi Produk</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">Rekomendasi</p>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Content Start -->
<div class="container-fluid py-5">
    <div class="container py-5">

        <?php if ($selectedProduct): ?>
            <!-- Back Button -->
            <div class="mb-4">
                <a href="rekomendasi.php" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Lihat Semua Produk
                </a>
            </div>

            <!-- Selected Product Section -->
            <div class="selected-product-section">
                <h2 class="text-primary mb-4"><i class="fas fa-star"></i> Produk yang Anda Pilih</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h3><?php echo htmlspecialchars($selectedProduct['name']); ?></h3>
                        <div class="product-details mt-3">
                            <p><strong><i class="fas fa-tag"></i> Brand:</strong> <?php echo htmlspecialchars($selectedProduct['brand']); ?></p>
                            <p><strong><i class="fas fa-layer-group"></i> Kategori:</strong> <?php echo htmlspecialchars($selectedProduct['category']); ?></p>
                            <p><strong><i class="fas fa-user"></i> Jenis Kulit:</strong> <?php echo htmlspecialchars($selectedProduct['skin_type']); ?></p>
                            <p class="product-rating">
                                <strong><i class="fas fa-star"></i> Rating:</strong>
                                <?php echo renderStars($selectedProduct['rating']); ?>
                                <span style="margin-left: 5px;"><?php echo $selectedProduct['rating']; ?>/5</span>
                            </p>
                            <p><strong><i class="fas fa-money-bill-wave"></i> Harga:</strong>
                                <span class="product-price"><?php echo formatPriceRange($selectedProduct['price_range']); ?></span>
                            </p>
                            <?php if (isset($selectedProduct['link']) && $selectedProduct['link'] != '#'): ?>
                                <a href="<?php echo htmlspecialchars($selectedProduct['link']); ?>" target="_blank" class="btn-shopee mt-3">
                                    <i class="fas fa-shopping-cart"></i> Beli Produk di Shopee
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="padding: 20px; background: #fef6f9; border-radius: 10px; border-left: 4px solid #ff9a8b;">
                            <p><strong><i class="fas fa-align-left"></i> Deskripsi Produk:</strong></p>
                            <p><?php echo htmlspecialchars($selectedProduct['description']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommendations Section -->
            <div class="row mb-4 mt-5">
                <div class="col-12">
                    <h2 class="section-title position-relative text-center mb-5">
                        <i class="fas fa-heart"></i> Rekomendasi Produk Serupa
                        <small class="d-block text-muted" style="font-size: 0.5em; margin-top: 10px;">
                            Ditemukan <?php echo count($recommendations); ?> produk
                        </small>
                    </h2>
                </div>
            </div>

            <?php if (count($recommendations) > 0): ?>
                <div class="row">
                    <i class="fas fa-heart"></i> Rekomendasi Produk Serupa
                    </h2>
                </div>
    </div>

    <div class="row">
        <?php foreach ($recommendations as $rec):
                    $product = $rec['product'];
                    $imagePath = !empty($product['gambar']) ? 'uploads/' . $product['gambar'] : 'img/placeholder-product.jpg';
        ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="product-card">
                    <!-- Gambar Produk -->
                    <div class="product-image">
                        <?php if (!empty($product['gambar']) && file_exists($imagePath)): ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <?php else: ?>
                            <div class="product-image-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card-header-section">
                        <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                        <div class="similarity-badge"><?php echo $rec['similarity']; ?>%</div>
                    </div>

                    <div class="product-info-section">
                        <div class="product-brand"><i class="fas fa-tag"></i> <?php echo htmlspecialchars($product['brand']); ?></div>
                        <div class="product-category"><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($product['category']); ?></div>

                        <div class="product-rating">
                            <?php echo renderStars($product['rating']); ?>
                            <span style="margin-left: 5px; color: var(--text-light); font-weight: 500;"><?php echo $product['rating']; ?></span>
                        </div>

                        <div style="margin-bottom: 10px; font-size: 0.85rem; color: var(--text-light);">
                            <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($product['skin_type']); ?>
                        </div>

                        <div class="product-price"><i class="fas fa-money-bill-wave"></i> <?php echo formatPriceRange($product['price_range']); ?></div>
                    </div>

                    <?php if (isset($product['link']) && $product['link'] != '#'): ?>
                        <div class="product-actions">
                            <a href="<?php echo htmlspecialchars($product['link']); ?>" target="_blank" class="btn btn-sm btn-secondary btn-block">
                                <i class="fas fa-shopping-cart"></i> Lihat di Shopee
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="text-center py-5">
        <i class="fas fa-info-circle" style="font-size: 3rem; color: #ff9a8b;"></i>
        <p class="mt-3 h5">Tidak ada produk rekomendasi yang ditemukan</p>
        <p class="text-muted">
            Total produk di database: <?php echo count($productsData); ?><br>
            Coba pilih produk lain untuk melihat rekomendasi
        </p>
        <a href="rekomendasi.php" class="btn btn-primary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk
        </a>
    </div>
<?php endif; ?>

<?php else: ?>
    <!-- All Products Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="section-title position-relative text-center mb-5">
                Semua Produk Kecantikan
                <small class="d-block text-muted" style="font-size: 0.5em; margin-top: 10px;">
                    Total <?php echo count($productsData); ?> produk
                </small>
            </h2>
        </div>
    </div>

    <?php if (count($productsData) > 0): ?>
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="text" id="searchInput" class="search-box" placeholder="Cari produk berdasarkan nama, brand, atau kategori..." onkeyup="searchProducts()">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <strong class="d-block mb-2">Filter by Category:</strong>
                    <button class="filter-btn active" onclick="filterProducts('all')">Semua</button>
                    <button class="filter-btn" onclick="filterProducts('Masker Wajah')">Masker Wajah</button>
                    <button class="filter-btn" onclick="filterProducts('Lipstick')">Lipstick</button>
                    <button class="filter-btn" onclick="filterProducts('Eyeshadow')">Eyeshadow</button>
                    <button class="filter-btn" onclick="filterProducts('Skincare Set')">Skincare Set</button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row" id="productsContainer">
            <?php foreach ($productsData as $product):
                    $imagePath = !empty($product['gambar']) ? 'uploads/' . $product['gambar'] : 'img/placeholder-product.jpg';
            ?>
                <div class="col-lg-3 col-md-6 mb-4 product-item" data-category="<?php echo htmlspecialchars($product['category']); ?>" data-name="<?php echo htmlspecialchars(strtolower($product['name'])); ?>" data-brand="<?php echo htmlspecialchars(strtolower($product['brand'])); ?>">
                    <div class="product-card">
                        <!-- Gambar Produk -->
                        <div class="product-image">
                            <?php if (!empty($product['gambar']) && file_exists($imagePath)): ?>
                                <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <?php else: ?>
                                <div class="product-image-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>

                        <div class="product-info-section">
                            <div class="product-brand"><i class="fas fa-tag"></i> <?php echo htmlspecialchars($product['brand']); ?></div>
                            <div class="product-category"><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($product['category']); ?></div>

                            <div class="product-rating">
                                <?php echo renderStars($product['rating']); ?>
                                <span style="margin-left: 5px; color: var(--text-light); font-weight: 500;"><?php echo $product['rating']; ?></span>
                            </div>

                            <div style="margin-bottom: 10px; font-size: 0.85rem; color: var(--text-light);">
                                <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($product['skin_type']); ?>
                            </div>

                            <div class="product-price"><i class="fas fa-money-bill-wave"></i> <?php echo formatPriceRange($product['price_range']); ?></div>
                        </div>

                        <div class="product-actions">
                            <a href="rekomendasi.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-sm btn-primary btn-block mb-2">
                                <i class="fas fa-heart"></i> Lihat Rekomendasi
                            </a>
                            <?php if (isset($product['link']) && $product['link'] != '#'): ?>
                                <a href="<?php echo htmlspecialchars($product['link']); ?>" target="_blank" class="btn btn-sm btn-secondary btn-block">
                                    <i class="fas fa-shopping-cart"></i> Beli Produk
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fas fa-box-open" style="font-size: 4rem; color: #ddd;"></i>
            <h4 class="mt-4 text-muted">Belum Ada Produk</h4>
            <p class="text-muted">
                Tidak ada produk yang tersedia di database.<br>
                Silakan tambahkan produk melalui halaman admin.
            </p>
            <a href="admin/produk-create.php" class="btn btn-primary mt-3">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>

</div>
</div>
<!-- Content End -->

<script>
    function searchProducts() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const products = document.querySelectorAll('.product-item');

        products.forEach(product => {
            const name = product.getAttribute('data-name');
            const brand = product.getAttribute('data-brand');
            const category = product.getAttribute('data-category').toLowerCase();

            if (name.includes(searchTerm) || brand.includes(searchTerm) || category.includes(searchTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    function filterProducts(category) {
        // Update active button
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');

        const products = document.querySelectorAll('.product-item');

        products.forEach(product => {
            const productCategory = product.getAttribute('data-category');

            if (category === 'all' || productCategory === category) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Animation on load
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.product-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
</script>

<?php include 'includes/footer.php'; ?>
