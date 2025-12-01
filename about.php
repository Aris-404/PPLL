<?php
// about.php — converted from about.html
include 'includes/header.php';
include_once 'includes/db.php';

$q = mysqli_query($conn, "SELECT * FROM tim ORDER BY id DESC");
$teams = [];
if($q){
    while($r = mysqli_fetch_assoc($q)) $teams[] = $r;
}

function h($v){ return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

?>

    <!-- Header Start (page title) -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">About</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">About</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h1 class="section-title position-relative text-center mb-5">Professional & Stylish Make Up Sejak 2005</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 py-5">
                    <h4 class="font-weight-bold mb-3">Tentang Kami</h4>
                    <h5 class="text-muted mb-3">Kami percaya bahwa kecantikan adalah kepercayaan diri, dan misi kami adalah meningkatkan kilau alami Anda dengan kosmetik premium..</h5>
                    <p>Mulai dari foundation hingga lipstik, produk kami dibuat dengan bahan berkualitas tinggi yang aman untuk semua jenis kulit.
Kami menggabungkan kreativitas dan inovasi untuk memberikan Anda pengalaman make up terbaik.</p>
                    <a href="" class="btn btn-secondary mt-2">Selengkapnya</a>
                </div>
                <div class="col-lg-4" style="min-height: 400px;">
                    <div class="position-relative h-100 rounded overflow-hidden">
                        <img class="position-absolute w-100 h-100" src="img/about.avif" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-5">
                    <h4 class="font-weight-bold mb-3">Keunggulan Kami</h4>
                    <p>Kami menyediakan produk kecantikan berkualitas tinggi yang dipercaya oleh para profesional. Dari formula yang ramah untuk perawatan kulit hingga lipstik tahan lama, kami memastikan setiap produk membuat Anda bersinar.</p>
                    <h5 class="text-muted mb-3"><i class="fa fa-check text-secondary mr-3"></i>Bahan Premium</h5>
                    <h5 class="text-muted mb-3"><i class="fa fa-check text-secondary mr-3"></i>Diuji oleh Dermatolog</h5>
                    <h5 class="text-muted mb-3"><i class="fa fa-check text-secondary mr-3"></i>Tren & Tahan Lama</h5>
                    <a href="" class="btn btn-primary mt-2">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="section-title position-relative mb-5">Tim Kami</h1>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0 pb-5 pb-lg-0"></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel team-carousel">
                        <?php if(!empty($teams)): ?>
                            <?php foreach($teams as $t):
                                $foto = (!empty($t['foto']) ? $t['foto'] : 'img/team-1.jpg');
                                $nama = !empty($t['nama']) ? $t['nama'] : 'Nama';
                                $nim = !empty($t['nim']) ? $t['nim'] : 'NIM';
                                $sos = !empty($t['sosmed']) ? $t['sosmed'] : '#';
                            ?>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="<?= h($foto) ?>" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5"><?= h($nama) ?></h3>
                                    <h6 class="text-uppercase text-muted mb-4"><?= h($nim) ?></h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="<?= h($sos) ?>"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="<?= h($sos) ?>"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="<?= h($sos) ?>"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback: original static items when DB empty -->
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/aris.jpg" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Aris</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100192</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/nita.jpg" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Nita</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100048</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/shafy.jpg" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Shafy</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100096</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/cinta.jpg" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Cinta</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100122</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/ridwan.PNG" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Ridwan</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100057</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/putri.jpg" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Putri</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100171</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/reza.PNG" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Reza</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100180</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item">
                                <div class="team-img mx-auto">
                                    <img class="rounded-circle w-100 h-100" src="img/bima.jpg" style="object-fit: cover;">
                                </div>
                                <div class="position-relative text-center bg-light rounded px-4 py-5" style="margin-top: -100px;">
                                    <h3 class="font-weight-bold mt-5 mb-3 pt-5">Bima</h3>
                                    <h6 class="text-uppercase text-muted mb-4">220411100119</h6>
                                    <div class="d-flex justify-content-center pt-1">
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="btn btn-outline-secondary btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

<?php include 'includes/footer.php'; ?>
