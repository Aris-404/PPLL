<?php include '../includes/db.php'; ?>

<?php
$id = $_GET['id'];

$data = $conn->query("SELECT * FROM tim  WHERE id=$id")->fetch_assoc();
$kategori = $conn->query("SELECT * FROM tim");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $sosmed= $_POST['sosmed'];
    $fotoLama = $_POST['foto_lama'];

    if (!empty($_FILES['foto']['name'])) {
        $fileName = time() . "-" . basename($_FILES["foto"]["name"]);
        move_uploaded_file($_FILES["foto"]["tmp_name"], "../uploads/$fileName");

        if (file_exists("../uploads/$fotoLama")) unlink("../uploads/$fotoLama");
    } else {
        $fileName = $fotoLama;
    }

    $conn->query("UPDATE tim SET 
        nama='$nama', foto='$fileName', 
        nim='$nim', sosmed='$sosmed' WHERE id=$id");

    header("Location: about-index.php");
    exit;
}
?>

<?php include '../includes/header-admin.php'; ?>

<div class="container py-5">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="fw-bold mb-4">Edit TIM</h3>

            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="foto_lama" value="<?= $data['foto']; ?>">

                <div class="mb-3">
                    <label class="form-label">nama</label>
                    <input type="text" name="nama" class="form-control"
                        value="<?= htmlspecialchars($data['nama']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">nim</label>
                    <input type="text" name="nim" value="<?= $data['nim']; ?>" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">sosmed</label>
                    <input type="text" name="sosmed" value="<?= $data['sosmed']; ?>" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini:</label><br>
                    <img src="../uploads/<?= $data['foto']; ?>" width="120" class="rounded border mb-2">
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-success w-100">Update</button>
            </form>

            <a href="about-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
        </div>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>