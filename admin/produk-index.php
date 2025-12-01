<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Daftar Produk</h3>
    <a href="produk-create.php" class="btn btn-primary">➕ Tambah Produk</a>
  </div>

  <table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Link</th>
        <th class="text-center" width="160">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;

      $sql = "SELECT p.*, k.nama AS nama_kategori 
                    FROM produk p 
                    LEFT JOIN kategori k ON p.kategori_id = k.id 
                    ORDER BY p.id DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><img src="../uploads/<?= $row['gambar']; ?>" width="60" class="rounded border"></td>
            <td><?= htmlspecialchars($row['judul']); ?></td>
            <td><?= $row['nama_kategori'] ?? '<i class="text-muted">Tidak ada</i>'; ?></td>
            <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td><a href="<?= $row['link']; ?>" target="_blank" class="btn btn-sm btn-info">🔗</a></td>
            <td class="text-center">
              <a href="produk-edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">✏ Edit</a>
              <a href="produk-delete.php?id=<?= $row['id']; ?>"
                onclick="return confirm('Yakin ingin menghapus produk ini?');"
                class="btn btn-danger btn-sm">🗑 Hapus</a>
            </td>
          </tr>
        <?php endwhile;
      else: ?>
        <tr>
          <td colspan="7" class="text-center text-muted">Belum ada data produk.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>