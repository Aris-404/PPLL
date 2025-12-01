<?php
// Contact page (PHP) — uses DB 'setting' values with fallbacks
include 'includes/header.php';
include_once 'includes/db.php';

$q = mysqli_query($conn, "SELECT * FROM setting ORDER BY id DESC LIMIT 1");
$setting = mysqli_fetch_assoc($q);

// Helper: safe value with fallback
function svalue($arr, $key, $fallback){
    if(!empty($arr) && isset($arr[$key]) && trim($arr[$key]) !== ''){
        return $arr[$key];
    }
    return $fallback;
}

$alamat = svalue($setting, 'alamat', "Jl. Raya Telang, Perumahan Telang Indah.");
$telp = svalue($setting, 'telp', '0878 6277 6120');
$jam = svalue($setting, 'jam_operasional', "Sen – Sab, 9AM – 7PM\nMinggu : Tutup");
$email = svalue($setting, 'email', 'info@glamup.com');
$ig = svalue($setting, 'ig', 'https://instagram.com/glamup_beauty');
$fb = svalue($setting, 'fb', 'https://facebook.com/glamupbeauty');
$wa_field = svalue($setting, 'wa', '6287862776120');

function build_wa_link($wa_field, $tel){
    $wa_field = trim($wa_field);
    if($wa_field === '' || $wa_field === '#'){
        return (!empty($tel) ? 'tel:'.preg_replace('/\D+/', '', $tel) : '#');
    }
    if(preg_match('~^https?://~i', $wa_field)){
        return $wa_field;
    }
    $digits = preg_replace('/\D+/', '', $wa_field);
    if($digits){
        return 'https://wa.me/' . $digits;
    }
    return (!empty($tel) ? 'tel:'.preg_replace('/\D+/', '', $tel) : '#');
}

$wa_link = build_wa_link($wa_field, $telp);

// sanitize for output
function h($v){ return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

?>

    <!-- Header (page-specific) -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px">
      <div class="container text-center py-5">
        <h1 class="text-white display-3 mt-lg-5">Contact</h1>
        <div class="d-inline-flex align-items-center text-white">
          <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
          <i class="fa fa-circle px-3"></i>
          <p class="m-0">Contact</p>
        </div>
      </div>
    </div>

    <!-- Contact Start -->
    <div class="container-fluid py-5">
      <div class="container py-5">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <h1 class="section-title position-relative text-center mb-5">Hubungi Kami</h1>
            <p class="text-center mb-5">Kami siap membantu Anda dengan layanan kecantikan terbaik. Jangan ragu untuk menghubungi kami melalui berbagai cara berikut.</p>
          </div>
        </div>

        <!-- Contact Info Cards -->
        <div class="row justify-content-center mb-5">
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="contact-info-card bg-white rounded shadow-sm p-4 h-100 text-center">
              <div class="contact-icon mb-3">
                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
              </div>
              <h5 class="mb-3">Alamat Kami</h5>
              <p class="mb-0"><?= nl2br(h($alamat)) ?></p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="contact-info-card bg-white rounded shadow-sm p-4 h-100 text-center">
              <div class="contact-icon mb-3">
                <i class="fas fa-clock fa-2x text-primary"></i>
              </div>
              <h5 class="mb-3">Jam Operasional</h5>
              <p class="mb-1"><?= nl2br(h($jam)) ?></p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="contact-info-card bg-white rounded shadow-sm p-4 h-100 text-center">
              <div class="contact-icon mb-3">
                <i class="fas fa-envelope fa-2x text-primary"></i>
              </div>
              <h5 class="mb-3">Email</h5>
              <p class="mb-0"><a href="mailto:<?= h($email) ?>" class="text-decoration-none"><?= h($email) ?></a></p>
            </div>
          </div>
        </div>

        <!-- Contact Methods -->
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="contact-methods rounded p-5">
              <h3 class="text-center mb-4">Cara Lain Menghubungi Kami</h3>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="contact-method d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="method-icon mr-3">
                      <i class="fab fa-whatsapp fa-2x whatsapp-icon"></i>
                    </div>
                    <div>
                      <h6 class="mb-1">WhatsApp</h6>
                      <a href="<?= h($wa_link) ?>" class="text-decoration-none" target="_blank"><?= h($telp) ?></a>
                      <p class="mb-0 small text-muted">Chat langsung dengan kami</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="contact-method d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="method-icon mr-3">
                      <i class="fas fa-phone fa-2x phone-icon"></i>
                    </div>
                    <div>
                      <h6 class="mb-1">Telepon</h6>
                      <a href="tel:<?= preg_replace('/\D+/', '', h($telp)) ?>" class="text-decoration-none"><?= h($telp) ?></a>
                      <p class="mb-0 small text-muted">Hubungi untuk konsultasi</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="contact-method d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="method-icon mr-3">
                      <i class="fab fa-instagram fa-2x instagram-icon"></i>
                    </div>
                    <div>
                      <h6 class="mb-1">Instagram</h6>
                      <a href="<?= h($ig) ?>" class="text-decoration-none" target="_blank"><?= h(parse_url($ig, PHP_URL_HOST) ?: $ig) ?></a>
                      <p class="mb-0 small text-muted">Lihat portfolio kami</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 mb-4">
                  <div class="contact-method d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="method-icon mr-3">
                      <i class="fab fa-facebook fa-2x facebook-icon"></i>
                    </div>
                    <div>
                      <h6 class="mb-1">Facebook</h6>
                      <a href="<?= h($fb) ?>" class="text-decoration-none" target="_blank"><?= h(parse_url($fb, PHP_URL_HOST) ?: $fb) ?></a>
                      <p class="mb-0 small text-muted">Follow untuk tips kecantikan</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Call to Action -->
              <div class="text-center mt-4">
                <h5 class="mb-3">Siap untuk Tampil Lebih Cantik?</h5>
                <p class="mb-4">Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran menarik!</p>
                <a href="<?= h($wa_link) ?>" class="btn btn-primary btn-lg px-5 mr-3" target="_blank"><i class="fab fa-whatsapp mr-2"></i>Chat WhatsApp</a>
                <a href="tel:<?= preg_replace('/\D+/', '', h($telp)) ?>" class="btn btn-outline-primary btn-lg px-5"><i class="fas fa-phone mr-2"></i>Telepon Sekarang</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->

<?php include 'includes/footer.php'; ?>
