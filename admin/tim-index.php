<?php
include '../includes/header-admin.php';
include_once '../includes/db.php';

$q = mysqli_query($conn, "SELECT * FROM tim ORDER BY id DESC");
?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Kelola Tim</h2>
            <a href="tim-create.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Anggota
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width:60px;">No</th>
                        <th style="width:120px;">Foto</th>
                        <th>Nama</th>
                        <th style="width:140px;">NIM</th>
                        <th style="width:200px;">Sosial</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $i=1; while($r = mysqli_fetch_assoc($q)): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>
                            <?php if(!empty($r['foto'])): ?>
                                <div style="width:80px;height:80px;margin:auto;overflow:hidden;border-radius:50%;">
                                    <img src="<?= htmlspecialchars($r['foto']) ?>" alt="foto" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                            <?php else: ?>
                                <div style="width:80px;height:80px;margin:auto;overflow:hidden;border-radius:50%;">
                                    <img src="../img/team-1.jpg" alt="no" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="text-start"><?= htmlspecialchars($r['nama']) ?></td>
                        <td><?= htmlspecialchars($r['nim']) ?></td>
                        <td><a href="<?= htmlspecialchars($r['sosmed']?:'#') ?>" target="_blank"><?= htmlspecialchars($r['sosmed']?:'-') ?></a></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="tim-edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="tim-delete.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus anggota ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
