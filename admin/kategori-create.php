<?php include '../includes/db.php'; ?>

<?php
$errors = [];
$nama = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $nama = trim($_POST['nama']);

  if ($nama == '') {
    $errors[] = 'Nama kategori wajib diisi.';
  }

  if (empty($errors)) {
    $conn->query("INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    header("Location: kategori-index.php");
    exit;
  }
}
?>

<?php include '../includes/header-admin.php'; ?>

<style>
  body.kategori-layout {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  body.kategori-layout > .container {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  body.kategori-layout footer {
    margin-top: auto !important;
  }
</style>
<script>
  document.body.classList.add('kategori-layout');
</script>

<div class="container py-5 d-flex flex-column justify-content-center">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Tambah Kategori</h3>

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

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
      </form>

      <a href="kategori-index.php" class="btn btn-link mt-3 px-0">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
