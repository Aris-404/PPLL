<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<?php
$result = $conn->query("SELECT * FROM kategori ORDER BY id DESC");
?>

<div class="container py-5 d-flex flex-column">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h3 class="fw-bold">Daftar Kategori</h3>
    <a href="kategori-create.php" class="btn btn-primary btn-sm">
      <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>
  </div>
  <div class="flex-grow-1">
    <table class="table table-bordered table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 70px;">No</th>
          <th>Nama Kategori</th>
          <th class="text-center" style="width: 160px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php $no = 1; ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
              <td class="text-center">
                <div class="d-flex flex-column align-items-center">
                  <a href="kategori-edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm mb-1" style="width: 90px;">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <a href="kategori-delete.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" style="width: 90px;"
                    onclick="return confirm('Yakin ingin menghapus kategori ini?');">
                    <i class="bi bi-trash"></i> Hapus
                  </a>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="3" class="text-center text-muted">Belum ada kategori yang tersimpan.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
