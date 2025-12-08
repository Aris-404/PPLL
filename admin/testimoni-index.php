<?php include '../includes/db.php'; ?>
<?php include '../includes/header-admin.php'; ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Daftar Testimoni</h3>
        <a href="testimoni-create.php" class="btn btn-primary">➕ Tambah Testimoni</a>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>nama</th>
                <th>jabatan</th>
                <th>deskripsi</th>
                <th class="text-center" width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;

            $sql = "SELECT p.*, k.nama AS nama
                    FROM testimoni p 
                    LEFT JOIN testimoni k ON p.id = k.id 
                    ORDER BY p.id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['jabatan']); ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="text-center">
                            <a href="testimoni-edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                            <a href="testimoni-delete.php?id=<?= $row['id']; ?>"
                                onclick="return confirm('Yakin ingin menghapus testimoni ini?');"
                                class="btn btn-danger btn-sm">🗑 Hapus</a>
                        </td>
                    </tr>
                <?php endwhile;
            else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data testimoni.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer-admin.php'; ?>