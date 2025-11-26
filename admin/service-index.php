<?php include './includes/db.php'; ?>
<?php include './includes/header.php'; ?>

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Daftar Service</h3>
    <a href="service-create.php" class="btn btn-primary">➕ Tambah Service</a>
  </div>

  <table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th class="text-center" width="150">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $result = $conn->query("SELECT * FROM service ORDER BY id DESC");
      if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
      ?>
          <tr>
            <td><?= $no++; ?></td>
            <td>
              <img src="uploads/<?= $row['gambar']; ?>" width="60" class="rounded border">
            </td>
            <td><?= htmlspecialchars($row['judul']); ?></td>
            <td><?= nl2br(htmlspecialchars($row['deskripsi'])); ?></td>
            <td class="text-center">
              <a href="service-edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">✏ Edit</a>
              <a href="service-delete.php?id=<?= $row['id']; ?>"
                onclick="return confirm('Yakin ingin menghapus?');"
                class="btn btn-danger btn-sm">🗑 Hapus</a>
            </td>
          </tr>
        <?php endwhile;
      else: ?>
        <tr>
          <td colspan="5" class="text-center text-muted">Belum ada data.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include './includes/footer.php'; ?>