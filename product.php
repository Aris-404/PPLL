<?php include './includes/db.php'; ?>

<?php $products = $conn->query("SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.kategori_id = k.id ORDER BY p.id DESC"); ?>

<?php include 'includes/header.php'; ?>
<div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h1 class="text-white display-3 mt-lg-5">Products</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="index.html">Home</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">Products</p>
        </div>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h1 class="section-title position-relative text-center mb-5">Temukan informasi lengkap tentang produk makeup favoritmu!</h1>
            </div>
        </div>
        <div class="row">
            <?php if ($products && $products->num_rows > 0): ?>
                <?php while ($row = $products->fetch_assoc()): ?>
                    <div class="col-lg-3 col-md-6 mb-4 pb-2">
                        <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">
                            <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                <h4 class="font-weight-bold text-white mb-0"></h4>
                            </div>
                            <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                <?php
                                $image = 'img/placeholder-product.jpg';
                                if (!empty($row['gambar'])) {
                                    $image = 'uploads/' . $row['gambar'];
                                }
                                ?>
                                <img class="rounded-circle w-100 h-100" src="<?= htmlspecialchars($image); ?>" style="object-fit: cover;">
                            </div>
                            <h5 class="font-weight-bold mb-4"><?= htmlspecialchars($row['judul']); ?></h5>
                            <div class="text-muted mb-2" style="font-size: 0.9rem;">
                                <?= htmlspecialchars($row['nama_kategori'] ?: 'Tanpa Kategori'); ?>
                            </div>
                            <div class="mb-3">
                                <h4 class="font-weight-bold text-primary mb-0">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></h4>
                            </div>
                            <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-secondary">Detail Products</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">Produk belum tersedia. Silakan cek kembali nanti.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>