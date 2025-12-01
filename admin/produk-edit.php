<?php include '../includes/db.php'; ?>

<?php include '../includes/header.php'; ?>

<div class="container py-5">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="fw-bold mb-4">Edit Produk</h3>

      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="gambar_lama" value="">

        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input type="text" name="judul" class="form-control"
            value="Judul" required>
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
          <input type="number" name="harga" value="10000" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Link Produk</label>
          <input type="url" name="link" value="https://example.com" required class="form-control">
        </div>

        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum ratione vero eius aspernatur odit velit natus quae pariatur suscipit!</textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Gambar Saat Ini:</label><br>
          <img src="../uploads/" width="120" class="rounded border mb-2">
          <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success w-100">Update</button>
      </form>

      <a href="produk-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>