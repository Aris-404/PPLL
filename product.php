<?php include "./includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GlamUp - Beauty & Make Up Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Make Up, Beauty, Skincare" name="keywords">
    <meta content="Professional Make Up & Beauty Care Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="">FAQs</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="">Help</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="">Support</a>
                        <span class="text-white">|</span>
                        <a class="text-white pl-3" href="contact.html">Contact</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Glam</span>Up</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="product.html" class="nav-item nav-link active">Products</a>
                    </div>
                    <a href="index.html" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Glam</span>Up</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="gallery.html" class="nav-item nav-link">Gallery</a>
                        <a href="rekomendasi.html" class="nav-item nav-link">Rekomendasi</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Products</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Products</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <?php
    // konfigurasi pagination
    $limit = 8; // items per page (ubah sesuai kebutuhan)
    $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    // ambil total data dulu
    $totalResult = $conn->query("SELECT COUNT(*) AS total FROM produk");
    $totalRow = $totalResult->fetch_assoc();
    $totalItems = (int) $totalRow['total'];
    $totalPages = (int) ceil($totalItems / $limit);

    // ambil data produk dengan limit/offset
    $sql = "SELECT p.*, k.nama_kategori 
        FROM produk p 
        LEFT JOIN kategori k ON p.kategori_id = k.id
        ORDER BY p.id DESC
        LIMIT $limit OFFSET $offset";
    $query = $conn->query($sql);
    ?>

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative text-center mb-5">
                        Temukan informasi lengkap tentang produk makeup favoritmu!
                    </h1>
                </div>
            </div>

            <div class="row">

                <?php if ($query && $query->num_rows > 0): ?>
                    <?php while ($produk = $query->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-6 mb-4 pb-2">
                            <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">

                                <!-- Badge harga (opsional) -->
                                <div class="bg-primary mt-n5 py-3" style="width: 80px;">
                                    <h4 class="font-weight-bold text-white mb-0">
                                        <?= $produk['harga'] > 0 ? 'Rp' . number_format($produk['harga'], 0, ',', '.') : ''; ?>
                                    </h4>
                                </div>

                                <!-- Gambar -->
                                <div class="position-relative bg-primary rounded-circle mt-n3 mb-4 p-3" style="width: 150px; height: 150px;">
                                    <img class="rounded-circle w-100 h-100"
                                        src="<?= htmlspecialchars($produk['gambar']); ?>"
                                        style="object-fit: cover;"
                                        alt="<?= htmlspecialchars($produk['judul']); ?>">
                                </div>

                                <!-- Judul -->
                                <h5 class="font-weight-bold mb-4">
                                    <?= htmlspecialchars($produk['judul']); ?>
                                </h5>

                                <!-- Tombol -->
                                <a href="<?= htmlspecialchars($produk['link'] ?: 'detail.php?id=' . $produk['id']); ?>"
                                    class="btn btn-sm btn-secondary" target="_blank">
                                    Detail Products
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center text-muted">Belum ada produk tersedia.</p>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- Prev -->
                                <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <!-- Page numbers: show window around current page -->
                                <?php
                                $maxLinks = 5; // jumlah maksimal nomor halaman yang ditampilkan
                                $start = max(1, $page - floor($maxLinks / 2));
                                $end = min($totalPages, $start + $maxLinks - 1);

                                if ($end - $start + 1 < $maxLinks) {
                                    $start = max(1, $end - $maxLinks + 1);
                                }

                                for ($i = $start; $i <= $end; $i++): ?>
                                    <li class="page-item <?= $i === $page ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next -->
                                <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <!-- Products End -->

    <!-- Footer Start -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index.html" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary">
                            <span class="text-secondary">Glam</span>Up
                        </h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-secondary btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        <div
                            class="col-sm-6 text-center text-sm-right border-right mb-3 mb-sm-0">
                            <h5 class="font-weight-bold mb-2">Hubungi Kami</h5>
                            <p class="mb-2">Jl. Raya Telang, Perumahan Telang Indah.</p>
                            <p class="mb-0">0878 6277 6120</p>
                        </div>
                        <div class="col-sm-6 text-center text-sm-left">
                            <h5 class="font-weight-bold mb-2">Jam Operasional</h5>
                            <p class="mb-2">Sen – Sab, 9AM – 7PM</p>
                            <p class="mb-0">Minggu : Tutup</p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0">
                        &copy; <a href="#">GlamUp</a>. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary px-2 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>