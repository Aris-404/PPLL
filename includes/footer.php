<?php
include __DIR__ . '/db.php';

$setting = null;
$q = mysqli_query($conn, "SELECT * FROM setting ORDER BY id DESC LIMIT 1");
if ($q && mysqli_num_rows($q) > 0) {
    $setting = mysqli_fetch_assoc($q);
}

$alamat = isset($setting['alamat']) && $setting['alamat'] !== '' ? $setting['alamat'] : 'Jl. Raya Telang, Perumahan Telang Indah.';
$telp = isset($setting['telp']) && $setting['telp'] !== '' ? $setting['telp'] : '0878 6277 6120';
$jam = isset($setting['jam_operasional']) && $setting['jam_operasional'] !== '' ? $setting['jam_operasional'] : 'Sen – Sab, 9AM – 7PM';
$wa = isset($setting['wa']) && $setting['wa'] !== '' ? $setting['wa'] : '#';
$ig = isset($setting['ig']) && $setting['ig'] !== '' ? $setting['ig'] : '#';
$fb = isset($setting['fb']) && $setting['fb'] !== '' ? $setting['fb'] : '#';

?>

    <!-- Footer Start -->
    <div class="container-fluid footer bg-light py-5" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="row">
                <div class="col-12 mb-4">
                    <a href="index.html" class="navbar-brand m-0">
                        <h1 class="m-0 mt-n2 display-4 text-primary"><span class="text-secondary">Glam</span>Up</h1>
                    </a>
                </div>
                <div class="col-12 mb-4">
                    <a class="btn btn-outline-secondary btn-social mr-2" href="<?php echo htmlspecialchars($wa !== '#' ? (preg_match('/^https?:\/\//i', $wa) ? $wa : 'https://wa.me/' . preg_replace('/\D+/', '', $wa)) : '#'); ?>"><i class="fab fa-whatsapp"></i></a>
                    <a class="btn btn-outline-secondary btn-social mr-2" href="<?php echo htmlspecialchars($fb); ?>"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-secondary btn-social" href="<?php echo htmlspecialchars($ig); ?>"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="col-12 mt-2 mb-4">
                    <div class="row">
                        <div class="col-sm-6 text-center text-sm-right border-right mb-3 mb-sm-0">
                            <h5 class="font-weight-bold mb-2">Hubungi Kami</h5>
                            <p class="mb-2"><?php echo nl2br(htmlspecialchars($alamat)); ?></p>
                            <p class="mb-0"><?php echo htmlspecialchars($telp); ?></p>
                        </div>
                        <div class="col-sm-6 text-center text-sm-left">
                            <h5 class="font-weight-bold mb-2">Jam Operasional</h5>
                            <p class="mb-2"><?php echo htmlspecialchars($jam); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <p class="m-0">&copy; <a href="#">GlamUp</a>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <a href="#" class="btn btn-secondary px-2 back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
