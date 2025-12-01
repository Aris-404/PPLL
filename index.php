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
                        <a class="text-white pr-3" href="">FAQ</a>
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
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="product.html" class="nav-item nav-link">Products</a>
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
                <div class="col-lg-6 mb-5 mb-lg-0 pb-5 pb-lg-0"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel product-carousel">

                        <?php
                        $query = $conn->query("SELECT * FROM produk ORDER BY id DESC");
                        if ($query->num_rows > 0) {
                            while ($produk = $query->fetch_assoc()) {
                        ?>

                                <div class="product-item d-flex flex-column align-items-center text-center bg-light rounded py-5 px-3">

                                    <h5 class="font-weight-bold mb-4">
                                        <?= htmlspecialchars($produk['judul']); ?>
                                    </h5>

                                    <div class="position-relative mb-4" style="width: 200px; height: 200px;">
                                        <img class="w-100 h-100" src="<?= htmlspecialchars($produk['gambar']); ?>"
                                            style="object-fit: cover; border-radius: 6px;"
                                            alt="<?= htmlspecialchars($produk['judul']); ?>">
                                    </div>

                                    <div class="mb-4">
                                        <h4 class="font-weight-bold text-primary mb-0">
                                            Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>
                                        </h4>
                                    </div>

                                    <a href="<?= htmlspecialchars($produk['link']); ?>"
                                        target="_blank"
                                        class="btn btn-sm btn-secondary">
                                        Order Now
                                    </a>
                                </div>

                        <?php
                            }
                        } else {
                            echo "<p class='text-center text-muted'>Belum ada produk.</p>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Home End-->

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


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <script src="js/main.js"></script>

</body>

</html>