<?php
include '../includes/db.php';

// Pastikan ada id
if (!isset($_GET['id'])) {
    header('Location: setting.php');
    exit;
}

$id = (int) $_GET['id'];

$res = mysqli_query($conn, "SELECT * FROM setting WHERE id = {$id} LIMIT 1");
if (!$res || mysqli_num_rows($res) === 0) {
    header('Location: setting.php');
    exit;
}

$row = mysqli_fetch_assoc($res);

if (isset($_POST['submit'])) {
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $jam_operasional = mysqli_real_escape_string($conn, $_POST['jam_operasional']);
    $wa = mysqli_real_escape_string($conn, $_POST['wa']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $ig = mysqli_real_escape_string($conn, $_POST['ig']);
    $fb = mysqli_real_escape_string($conn, $_POST['fb']);

    $sql = "UPDATE setting SET alamat='{$alamat}', email='{$email}', jam_operasional='{$jam_operasional}', wa='{$wa}', telp='{$telp}', ig='{$ig}', fb='{$fb}' WHERE id={$id}";

    if (mysqli_query($conn, $sql)) {
        header('Location: setting.php');
        exit;
    } else {
        $error = 'SQL Error: ' . mysqli_error($conn);
    }
}

include '../includes/header-admin.php';
?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php } ?>

        <form action="" method="POST">

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required><?= isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : htmlspecialchars($row['alamat']); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($row['email']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Operasional</label>
                <input type="text" name="jam_operasional" class="form-control" value="<?= isset($_POST['jam_operasional']) ? htmlspecialchars($_POST['jam_operasional']) : htmlspecialchars($row['jam_operasional']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">WA</label>
                <input type="text" name="wa" class="form-control" value="<?= isset($_POST['wa']) ? htmlspecialchars($_POST['wa']) : htmlspecialchars($row['wa']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Telp</label>
                <input type="text" name="telp" class="form-control" value="<?= isset($_POST['telp']) ? htmlspecialchars($_POST['telp']) : htmlspecialchars($row['telp']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Instagram</label>
                <input type="text" name="ig" class="form-control" value="<?= isset($_POST['ig']) ? htmlspecialchars($_POST['ig']) : htmlspecialchars($row['ig']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Facebook</label>
                <input type="text" name="fb" class="form-control" value="<?= isset($_POST['fb']) ? htmlspecialchars($_POST['fb']) : htmlspecialchars($row['fb']); ?>">
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="setting.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
