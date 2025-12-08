<?php
include __DIR__ . '/db.php';

$setting = null;
$q = mysqli_query($conn, "SELECT * FROM setting ORDER BY id DESC LIMIT 1");
if ($q && mysqli_num_rows($q) > 0) {
  $setting = mysqli_fetch_assoc($q);
}

$wa = isset($setting['wa']) && $setting['wa'] !== '' ? $setting['wa'] : '#';
$ig = isset($setting['ig']) && $setting['ig'] !== '' ? $setting['ig'] : '#';
$fb = isset($setting['fb']) && $setting['fb'] !== '' ? $setting['fb'] : '#';
$telp = isset($setting['telp']) && $setting['telp'] !== '' ? $setting['telp'] : '0878 6277 6120';

// build whatsapp link: if it's a full URL use it, otherwise try to convert to wa.me with digits
$wa_link = '#';
if ($wa && $wa !== '#') {
  if (preg_match('/^https?:\/\//i', $wa)) {
    $wa_link = $wa;
  } else {
    $digits = preg_replace('/\D+/', '', $wa);
    if ($digits) {
      $wa_link = 'https://wa.me/' . $digits;
    } else {
      $wa_link = 'tel:' . $wa;
    }
  }
}

?>

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

  <!-- Custom CSS untuk gambar grid -->
  <style>
    .portfolio-item img {
      width: 100%;
      height: 300px;
      /* ukuran seragam */
      object-fit: cover;
      /* biar penuh dan rapi, meski terpotong */
      border-radius: 8px;
    }

    @media (max-width: 768px) {
      .portfolio-item img {
        height: 200px;
      }
    }

    /* Active nav link color (pink) */
    .navbar .nav-item .nav-link.active {
      color: #ff69b4 !important;
    }
  </style>
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
            <a class="text-white pl-3" href="contact.php">Contact</a>
          </div>
        </div>
        <div class="col-md-6 text-center text-lg-right">
          <div class="d-inline-flex align-items-center">
            <a class="text-white px-3" href="<?php echo htmlspecialchars($fb); ?>">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="text-white px-3" href="<?php echo htmlspecialchars($wa_link); ?>">
              <i class="fab fa-whatsapp"></i>
            </a>
            <a class="text-white px-3" href="<?php echo htmlspecialchars($ig); ?>">
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
        <a href="index.php" class="navbar-brand d-block d-lg-none">
          <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Glam</span>Up</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          <?php
          // Helper to mark active nav link based on current script name
          $currentPage = basename($_SERVER['SCRIPT_NAME']);
          function nav_active($names)
          {
            global $currentPage;
            foreach ($names as $n) {
              if ($currentPage === $n) return 'active';
            }
            return '';
          }
          ?>

          <div class="navbar-nav ml-auto py-0">
            <a href="index.php" class="nav-item nav-link <?php echo nav_active(array('index.php', 'index.html')); ?>">Home</a>
            <a href="about.php" class="nav-item nav-link <?php echo nav_active(array('about.php')); ?>">About</a>
            <a href="product.php" class="nav-item nav-link <?php echo nav_active(array('product.php')); ?>">Products</a>
          </div>
          <a href="index.php" class="navbar-brand mx-5 d-none d-lg-block">
            <h1 class="m-0 display-4 text-primary"><span class="text-secondary">Glam</span>Up</h1>
          </a>
          <div class="navbar-nav mr-auto py-0">
            <a href="service.php" class="nav-item nav-link <?php echo nav_active(array('service.php')); ?>">Services</a>
            <a href="gallery.php" class="nav-item nav-link <?php echo nav_active(array('gallery.php', 'gallery.html')); ?>">Gallery</a>
            <a href="rekomendasi.html" class="nav-item nav-link <?php echo nav_active(array('rekomendasi.html')); ?>">Rekomendasi</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
  <!-- Navbar End -->