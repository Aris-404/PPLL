<?php include '../includes/db.php'; ?>

<?php include '../includes/header.php'; ?>

<div class="container py-5">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Tambah Produk</h3>

      <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label">Judul Produk</label>
          <input type="text" name="judul" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="kategori_id" class="form-select">
            <option value="">-- Pilih Kategori --</option>
            <option value="">Kategori 1</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Harga</label>
          <input type="number" name="harga" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Link Produk</label>
          <input type="url" name="link" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Gambar Produk</label>
          <input type="file" name="gambar" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Simpan</button>
      </form>

      <a href="produk-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>