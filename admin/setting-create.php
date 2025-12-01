<?php include '../includes/header-admin.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
if (isset($_POST['submit'])) {
    // Ambil dan escape input
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $jam_operasional = mysqli_real_escape_string($conn, $_POST['jam_operasional']);
    $wa = mysqli_real_escape_string($conn, $_POST['wa']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $ig = mysqli_real_escape_string($conn, $_POST['ig']);
    $fb = mysqli_real_escape_string($conn, $_POST['fb']);

    // Insert ke table setting
    $sql = "INSERT INTO setting (alamat, email, jam_operasional, wa, telp, ig, fb) VALUES ('{$alamat}', '{$email}', '{$jam_operasional}', '{$wa}', '{$telp}', '{$ig}', '{$fb}')";

    if (mysqli_query($conn, $sql)) {
        header('Location: setting.php');
        exit;
    } else {
        $error = 'SQL Error: ' . mysqli_error($conn);
    }
}
?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">➕ Tambah Pengaturan</h3>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php } ?>

        <form action="" method="POST">

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat" required><?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Operasional</label>
                <input type="text" name="jam_operasional" class="form-control" placeholder="Masukkan jam operasional (contoh: Senin-Jumat 08:00-17:00)" value="<?= isset($_POST['jam_operasional']) ? htmlspecialchars($_POST['jam_operasional']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">WA</label>
                <input type="text" name="wa" class="form-control" placeholder="Masukkan nomor WA (contoh: 6281234567890)" value="<?= isset($_POST['wa']) ? htmlspecialchars($_POST['wa']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Telp</label>
                <input type="text" name="telp" class="form-control" placeholder="Masukkan nomor telepon" value="<?= isset($_POST['telp']) ? htmlspecialchars($_POST['telp']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Instagram</label>
                <input type="text" name="ig" class="form-control" placeholder="Masukkan username Instagram (tanpa @)" value="<?= isset($_POST['ig']) ? htmlspecialchars($_POST['ig']) : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Facebook</label>
                <input type="text" name="fb" class="form-control" placeholder="Masukkan link atau username Facebook" value="<?= isset($_POST['fb']) ? htmlspecialchars($_POST['fb']) : ''; ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="setting.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
