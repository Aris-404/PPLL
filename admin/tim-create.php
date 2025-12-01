<?php
include '../includes/header-admin.php';
include_once '../includes/db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $sosmed = mysqli_real_escape_string($conn, $_POST['sosmed']);

    $foto_path = '';
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $newname = 'upload/tim_' . time() . '_' . rand(1000,9999) . '.' . $ext;
        if(move_uploaded_file($_FILES['foto']['tmp_name'], '../' . $newname)){
            $foto_path = $newname;
        }
    }

    $sql = "INSERT INTO tim (nama,nim,foto,sosmed) VALUES ('". $nama ."','". $nim ."','". $foto_path ."','". $sosmed ."')";
    mysqli_query($conn, $sql);
    header('Location: tim-index.php');
    exit;
}

?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">➕ Tambah Anggota Tim</h3>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" accept="image/*" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Sosial (link)</label>
                <input type="text" name="sosmed" class="form-control" placeholder="https://instagram.com/username">
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="tim-index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
