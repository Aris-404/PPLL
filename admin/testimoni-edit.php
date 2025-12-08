<?php include '../includes/db.php'; ?>

<?php
$id = $_GET['id'];

$data = $conn->query("SELECT * FROM testimoni  WHERE id=$id")->fetch_assoc();
$kategori = $conn->query("SELECT * FROM testimoni");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];

    $conn->query("UPDATE testimoni SET 
        nama='$nama', jabatan='$jabatan', deskripsi='$deskripsi' WHERE id=$id");

    header("Location: testimoni-index.php");
    exit;
}
?>

<?php include '../includes/header-admin.php'; ?>

<div class="container py-5">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="fw-bold mb-4">Edit Testimoni</h3>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">nama</label>
                    <input type="text" name="nama" class="form-control"
                        value="<?= htmlspecialchars($data['nama']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">jabatan</label>
                    <input type="text" name="jabatan" value="<?= $data['jabatan']; ?>" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Update</button>
            </form>

            <a href="testimoni-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
        </div>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>