<?php include '../includes/db.php'; ?>

<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM kategori WHERE id=$id")->fetch_assoc();

if (!$data) {
  header("Location: kategori-index.php");
  exit;
}

$errors = [];
$nama = $data['nama_kategori'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nama = trim($_POST['nama']);

  if ($nama == '') {
    $errors[] = 'Nama kategori wajib diisi.';
  }

  if (empty($errors)) {
    $conn->query("UPDATE kategori SET nama_kategori='$nama' WHERE id=$id");
    header("Location: kategori-index.php");
    exit;
  }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container py-5 d-flex flex-column justify-content-center">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Edit Kategori</h3>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger" role="alert">
          <?= implode('<br>', array_map('htmlspecialchars', $errors)); ?>
        </div>
      <?php endif; ?>

      <form method="POST" autocomplete="off">
        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama); ?>" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Update</button>
      </form>

      <a href="kategori-index.php" class="btn btn-link mt-3 px-0">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
