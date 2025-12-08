<?php
<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Header Start -->
<div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
    <div class="container text-center py-5">
        <h1 class="text-white display-3 mt-lg-5">Beauty Products</h1>
        <div class="d-inline-flex align-items-center text-white">
            <p class="m-0"><a class="text-white" href="">Cosmetic</a></p>
            <i class="fa fa-circle px-3"></i>
            <p class="m-0">Elegant</p>
        </div>
    </div>
</div>
<!-- Header End -->

<!--Home Start-->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="section-title position-relative mb-5">Best Seller Products</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="owl-carousel product-carousel">

                    <?php
                    // Ambil data produk dari DB
                    $query = "SELECT * FROM produk ORDER BY id DESC LIMIT 20";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">

                                <!-- Nama Produk -->
                                <h5 class="font-weight-bold mb-4"><?= $row['judul']; ?></h5>

                                <!-- Gambar -->
                                <div class="position-relative mb-4" style="width: 200px; height: 200px;">
                                    <img class="w-100 h-100"
                                        src="uploads/<?= $row['gambar']; ?>"
                                        style="object-fit: cover; border-radius: 6px;">
                                </div>

                                <!-- Harga -->
                                <div class="mb-4">
                                    <h4 class="font-weight-bold text-primary mb-0">
                                        Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                    </h4>
                                </div>

                                <!-- Tombol Order dan Rekomendasi -->
                                <div class="d-flex gap-2">
                                    <a href="./detail.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-secondary mr-2">
                                        <i class="fa fa-info-circle"></i> Detail Produk
                                    </a>
                                    <a href="./rekomendasi.php?product_id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="fa fa-star"></i> Lihat Rekomendasi
                                    </a>
                                </div>
                            </div>

                    <?php
                        }
                    } else {
                        echo "<p class='text-center py-5'>Belum ada produk tersedia.</p>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--Home End-->

<?php include 'includes/footer.php'; ?>
