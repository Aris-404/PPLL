<?php include '../includes/header-admin.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
$kategori = $conn->query("SELECT * FROM tim");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $sosmet = $_POST['sosmed'];

    // Upload gambar
    $fileName = time() . "-" . basename($_FILES["foto"]["name"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"], "../uploads/$fileName");

    $conn->query("INSERT INTO tim (nama, nim, foto, sosmed)
                    VALUES ('$nama','$nim','$fileName','$sosmet')");

    header("Location: about-index.php");
    exit;
}
?>

<div class="container py-5">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="fw-bold mb-4">Tambah tim</h3>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">nama</label>
                    <input type="text" name="nama" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">nim</label>
                    <input type="number" name="nim" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">sosmed</label>
                    <input type="text" name="sosmed" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">foto</label>
                    <input type="file" name="foto" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>

            <a href="produk-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
        </div>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
