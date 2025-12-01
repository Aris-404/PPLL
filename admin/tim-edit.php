<?php
include '../includes/header-admin.php';
include_once '../includes/db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if(!$id){ header('Location: tim-index.php'); exit; }

$q = mysqli_query($conn, "SELECT * FROM tim WHERE id=". $id);
$row = mysqli_fetch_assoc($q);
if(!$row){ header('Location: tim-index.php'); exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $sosmed = mysqli_real_escape_string($conn, $_POST['sosmed']);

    $foto_path = $row['foto'];
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK){
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $newname = 'upload/tim_' . time() . '_' . rand(1000,9999) . '.' . $ext;
        if(move_uploaded_file($_FILES['foto']['tmp_name'], '../' . $newname)){
            // remove old file only if it's in upload/ folder
            if(!empty($foto_path) && strpos($foto_path, 'upload/') === 0 && file_exists('../' . $foto_path)){
                @unlink('../' . $foto_path);
            }
            $foto_path = $newname;
        }
    }

    $sql = "UPDATE tim SET nama='". $nama ."', nim='". $nim ."', foto='". $foto_path ."', sosmed='". $sosmed ."' WHERE id=". $id;
    mysqli_query($conn, $sql);
    header('Location: tim-index.php');
    exit;
}

?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">✏ Edit Anggota Tim</h3>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($row['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($row['nim']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Foto saat ini</label>
                <?php if(!empty($row['foto'])): ?>
                    <img src="<?= htmlspecialchars($row['foto']) ?>" style="width:120px;height:120px;object-fit:cover;border-radius:50%;">
                <?php else: ?>
                    <img src="../img/team-1.jpg" style="width:120px;height:120px;object-fit:cover;border-radius:50%;">
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Foto (opsional)</label>
                <input type="file" name="foto" accept="image/*" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Sosial (link)</label>
                <input type="text" name="sosmed" class="form-control" value="<?= htmlspecialchars($row['sosmed']) ?>">
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="tim-index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
