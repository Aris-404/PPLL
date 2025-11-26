<?php include './includes/db.php'; ?>

<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM service WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $gambarLama = $_POST['gambar_lama'];

  // Jika gambar diganti
  if (!empty($_FILES['gambar']['name'])) {
    $fileName = time() . "-" . basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], "uploads/" . $fileName);

    // Hapus gambar lama
    if (file_exists("uploads/" . $gambarLama)) unlink("uploads/" . $gambarLama);
  } else {
    $fileName = $gambarLama;
  }

  $conn->query("UPDATE service SET judul='$judul', deskripsi='$deskripsi', gambar='$fileName' WHERE id=$id");
  header("Location: service-index.php");
  exit;
}
?>

<?php include './includes/header.php'; ?>

<div class="container py-5">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Edit Service</h3>

      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">

        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']); ?>" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Gambar Saat Ini</label><br>
          <img src="uploads/<?= $data['gambar']; ?>" width="120" class="rounded border mb-2">
          <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success w-100">Update</button>
      </form>

      <a href="service-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include './includes/footer.php'; ?>