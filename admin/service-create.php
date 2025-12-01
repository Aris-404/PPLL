<?php include '../includes/db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];

  // Upload file
  $fileName = time() . "-" . basename($_FILES["gambar"]["name"]);
  $targetDir = "../uploads/" . $fileName;
  move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetDir);

  $conn->query("INSERT INTO service (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$fileName')");
  header("Location: service-index.php");
  exit;
}
?>

<?php include '../includes/header-admin.php'; ?>

<div class="container py-5">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Tambah Service</h3>

      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input type="text" name="judul" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Gambar</label>
          <input type="file" name="gambar" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
      </form>

      <a href="service-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
