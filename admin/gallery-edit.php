<?php 
include '../includes/header-admin.php';
include '../includes/db.php';

// Ambil ID
$id = $_GET['id'];

// Ambil data gallery berdasarkan ID
$query = mysqli_query($conn, 
    "SELECT * FROM gallery WHERE id = $id"
);
$data = mysqli_fetch_assoc($query);

// Ambil semua kategori
$kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori");

// Proses Update
if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $kategori_id = $_POST['kategori_id'];

    // Cek jika update gambar baru
    if ($_FILES['gambar']['name'] != "") {

        $filename = time() . "_" . $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../upload/" . $filename);

        // Hapus file lama
        if (file_exists("../upload/" . $data['gambar'])) {
            unlink("../upload/" . $data['gambar']);
        }

        $updateQuery = "
            UPDATE gallery 
            SET title='$title', kategori_id='$kategori_id', gambar='$filename'
            WHERE id=$id
        ";

    } else {
        // Jika tidak update gambar
        $updateQuery = "
            UPDATE gallery 
            SET title='$title', kategori_id='$kategori_id'
            WHERE id=$id
        ";
    }

    mysqli_query($conn, $updateQuery);
    header("Location: gallery-index.php");
    exit();
}
?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">✏ Edit Data Gallery</h3>

        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Gambar</label>
                <input type="text" name="title" class="form-control" 
                       value="<?= $data['title']; ?>" required>
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>

                    <?php while ($row = mysqli_fetch_assoc($kategoriQuery)) { ?>
                        <option value="<?= $row['id']; ?>"
                            <?= $row['id'] == $data['kategori_id'] ? 'selected' : '' ?>>
                            <?= $row['nama_kategori']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- Gambar Lama -->
            <div class="mb-3">
                <label class="form-label d-block">Gambar Lama</label>
                <img src="../upload/<?= $data['gambar']; ?>" 
                     class="img-thumbnail mb-2" 
                     style="width: 15%; height: 100%; object-fit: contain;">
            </div>

            <!-- Upload gambar baru -->
            <div class="mb-3">
                <label class="form-label">Ganti Gambar (Opsional)</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <!-- Tombol -->
            <button type="submit" name="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>
            <a href="gallery-index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php include '../includes/footer-admin.php'; ?>
