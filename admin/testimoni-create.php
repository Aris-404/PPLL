<?php include '../includes/header-admin.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
$kategori = $conn->query("SELECT * FROM testimoni");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $deskripsi = $_POST['deskripsi'];


    $conn->query("INSERT INTO testimoni (nama, jabatan, deskripsi)
                    VALUES ('$nama','$jabatan','$deskripsi')");

    header("Location: testimoni-index.php");
    exit;
}
?>

<div class="container py-5">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="fw-bold mb-4">Tambah Testimoni</h3>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">nama</label>
                    <input type="text" name="nama" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">jabatan</label>
                    <input type="text" name="jabatan" required class="form-control">
                </div>
    
                <div class="mb-3">
                    <label class="form-label">deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>

            <a href="testimoni-index.php" class="btn btn-link mt-3">⬅ Kembali</a>
        </div>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
