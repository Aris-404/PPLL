<?php include_once './includes/db.php'; ?>

<?php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = null;

if ($id > 0) {
  $result = $conn->query("SELECT p.*, k.nama_kategori FROM produk p LEFT JOIN kategori k ON p.kategori_id = k.id WHERE p.id = $id");
  if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
  }
}

$title = $product ? $product['judul'] : 'Produk Tidak Ditemukan';
$category = $product && $product['nama_kategori'] ? $product['nama_kategori'] : 'Tanpa Kategori';
$price = $product ? 'Rp' . number_format($product['harga'], 0, ',', '.') : '-';
$link = $product && $product['link'] ? $product['link'] : 'product.html';
$imagePath = 'img/placeholder-product.jpg';

if ($product && !empty($product['gambar'])) {
  $imagePath = 'uploads/' . $product['gambar'];
}
?>

<?php include './includes/header.php'; ?>

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

  <?php if ($product): ?>
    <div class="container-fluid my-5 py-5 px-0">
      <div class="row bg-primary m-0">
        <div class="col-md-6 px-0" style="min-height: 500px;">
          <div class="position-relative h-100">
            <img class="position-absolute w-100 h-100" src="<?= htmlspecialchars($imagePath); ?>" style="object-fit: cover;">
          </div>
        </div>
        <div class="col-md-6 py-5 py-md-0 px-0">
          <div class="h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
            <span class="badge badge-light text-primary px-3 py-2 mb-3" style="font-size: 15px; font-weight: 500;">
              Kategori: <?= htmlspecialchars($category); ?>
            </span>
            <h3 class="font-weight-bold text-white mt-2 mb-3">
              <?= htmlspecialchars($title); ?>
            </h3>
            <h4 class="text-white mb-3" style="font-weight: 600;">
              <?= htmlspecialchars($price); ?>
            </h4>
            <p class="text-white mb-4">
              <?= nl2br(htmlspecialchars($product['deskripsi'])); ?>
            </p>
            <a href="<?= htmlspecialchars($link); ?>" class="btn btn-secondary py-3 px-5 mt-2" target="_blank" rel="noopener">
              Order Now
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h3 class="mb-3">Produk tidak ditemukan</h3>
          <p class="text-muted">Produk yang kamu cari sudah tidak tersedia atau ID tidak valid.</p>
          <a href="product.html" class="btn btn-primary mt-3">Kembali ke Daftar Produk</a>
        </div>
      </div>
    </div>
  <?php endif; ?>

<?php include './includes/footer.php'; ?>