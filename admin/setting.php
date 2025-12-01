<?php include '../includes/db.php'; ?>

<?php
// Ambil semua setting
$settingQuery = mysqli_query($conn, "SELECT * FROM setting ORDER BY id DESC");

// Jika belum ada setting, alihkan ke halaman create sebelum mengeluarkan output
if (mysqli_num_rows($settingQuery) === 0) {
    header("Location: setting-create.php");
    exit;
}

include '../includes/header-admin.php';
?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">⚙️ Pengaturan Situs</h3>

        <div class="mb-3">
            <?php
            // Ambil id setting terbaru untuk link edit (gunakan satu query yang ringkas)
            $latestRes = mysqli_query($conn, "SELECT id FROM setting ORDER BY id DESC LIMIT 1");
            $editLink = 'setting-edit.php';
            if ($latestRes && mysqli_num_rows($latestRes) > 0) {
                $latestRow = mysqli_fetch_assoc($latestRes);
                $editLink .= '?id=' . $latestRow['id'];
            }
            ?>
            <a href="<?= $editLink; ?>" class="btn btn-primary">✏️ Edit Setting</a>
        </div>

        <?php if (mysqli_num_rows($settingQuery) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($settingQuery)) { ?>
                <div class="mb-4 p-3 border rounded">
                    <!-- Alamat (textarea, readonly) -->
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3" disabled placeholder="<?= htmlspecialchars($row['alamat']); ?>"></textarea>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row['email']); ?>" disabled>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="mb-3">
                        <label class="form-label">Jam Operasional</label>
                        <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row['jam_operasional']); ?>" disabled>
                    </div>

                    <!-- WA -->
                    <div class="mb-3">
                        <label class="form-label">WA</label>
                        <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row['wa']); ?>" disabled>
                    </div>

                    <!-- Telp -->
                    <div class="mb-3">
                        <label class="form-label">Telp</label>
                        <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row['telp']); ?>" disabled>
                    </div>

                    <!-- Instagram -->
                    <div class="mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row['ig']); ?>" disabled>
                    </div>

                    <!-- Facebook -->
                    <div class="mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="text" class="form-control" placeholder="<?= htmlspecialchars($row['fb']); ?>" disabled>
                    </div>

                    <!-- per-row Edit button removed as requested -->
                </div>
            <?php } ?>

        <?php } ?>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
