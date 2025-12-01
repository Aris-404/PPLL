<?php 
include '../includes/header.php';
include '../includes/db.php';
?>

<h2 class="mb-4">Kelola Gallery</h2>

<!-- Tombol Tambah dengan Icon -->
<a href="gallery-create.php" class="btn btn-primary mb-3">
    <i class="bi bi-plus-circle"></i> Tambah Gambar
</a>

<?php
// Pagination
$limit = 5; // data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM gallery");
$totalData = mysqli_fetch_assoc($totalQuery)['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data sesuai halaman
$query = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC LIMIT $start, $limit");
?>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">

        <thead class="table-dark text-center">
            <tr>
                <th style="width: 50px;">No</th>
                <th style="width: 180px;">Judul</th>
                <th style="width: 150px;">Kategori</th>
                <th style="width: 45%;">Gambar</th>
                <th style="width: 170px;">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-center">
            <?php
            $no = $start + 1;
            while ($row = mysqli_fetch_assoc($query)) {
                $kategoriNama = "-";
                if ($row['kategori_id']) {
                    $kat = mysqli_query($conn, 
                        "SELECT nama_kategori FROM kategori WHERE id = ".$row['kategori_id']
                    );
                    $kategoriNama = mysqli_fetch_assoc($kat)['nama_kategori'];
                }
            ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['title']); ?></td>
                <td><?= htmlspecialchars($kategoriNama); ?></td>
                <td>
                    <div style="width: 100%; max-width: 600px; height: 350px; background:#f8f9fa; display:flex; justify-content:center; align-items:center; border-radius:8px; overflow:hidden;">
                        <img src="../upload/<?= $row['gambar']; ?>" 
                            class="img-fluid"
                            style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                </td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="gallery-edit.php?id=<?= $row['id']; ?>" 
                       class="btn btn-warning btn-sm mb-1" style="width: 75px;">
                        <i class="bi bi-pencil-square"></i>Edit
                    </a><br>
                    <!-- Tombol Hapus -->
                    <a href="gallery-delete.php?id=<?= $row['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       style="width: 75px;"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="bi bi-trash"></i>Hapus
                    </a>
                </td>
            </tr>

            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Pagination Links -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page-1 ?>"><i class="bi bi-chevron-left"></i> Prev</a>
            </li>
        <?php endif; ?>

        <?php for($i=1; $i<=$totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page+1 ?>">Next <i class="bi bi-chevron-right"></i></a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php include '../includes/footer.php'; ?>
