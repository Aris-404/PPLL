<?php include '../includes/db.php'; ?>

<?php
$id = $_GET['id'];

$data = $conn->query("SELECT * FROM produk WHERE id=$id")->fetch_assoc();
$kategori = $conn->query("SELECT * FROM kategori");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $kategori_id = $_POST['kategori_id'] ?: 'NULL';
  $harga = $_POST['harga'];
  $link = $_POST['link'];
  $gambarLama = $_POST['gambar_lama'];

  if (!empty($_FILES['gambar']['name'])) {
    $fileName = time() . "-" . basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "../uploads/$fileName");

    if (file_exists("../uploads/$gambarLama")) unlink("../uploads/$gambarLama");
  } else {
    $fileName = $gambarLama;
  }

  $conn->query("UPDATE produk SET 
        judul='$judul', gambar='$fileName', deskripsi='$deskripsi', kategori_id=$kategori_id, 
        harga='$harga', link='$link' WHERE id=$id");

  header("Location: produk-index.php");
  exit;
}
?>

<?php include '../includes/header.php'; ?>

<div class="container py-5">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Edit Produk</h3>

      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">

        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input type="text" name="judul" class="form-control"
            value="<?= htmlspecialchars($data['judul']); ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="kategori_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            <?php while ($k = $kategori->fetch_assoc()): ?>
              <option value="<?= $k['id']; ?>" <?= $k['id'] == $data['kategori_id'] ? 'selected' : ''; ?>>
                <?= $k['nama']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga</label>
          <input type="number" name="harga" value="<?= $data['harga']; ?>" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Link Produk</label>
          <input type="url" name="link" value="<?= $data['link']; ?>" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Gambar Saat Ini:</label><br>
          <img src="../uploads/<?= $data['gambar']; ?>" width="120" class="rounded border mb-2">
          <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success w-100">Update</button>
      </form>

      <a href="produk-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>