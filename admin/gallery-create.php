<?php include '../includes/header.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
// Ambil kategori
$kategoriQuery = mysqli_query($conn, "SELECT * FROM kategori");

if (isset($_POST['submit'])) {

    // Validasi kategori
    if (empty($_POST['kategori_id'])) {
        echo "<script>alert('Kategori wajib dipilih!');</script>";
    } else {

        $title = $_POST['title'];
        $kategori_id = $_POST['kategori_id'];

        // Upload file
        $filename = time() . "_" . $_FILES["image"]["name"];
        $temp = $_FILES["image"]["tmp_name"];

        // Pastikan folder upload ada
        if (!is_dir("../upload")) {
            mkdir("../upload", 0777, true);
        }

        move_uploaded_file($temp, "../upload/" . $filename);

        // Query INSERT sesuai kolom table gallery
        $sql = "INSERT INTO gallery (title, kategori_id, gambar) 
                VALUES ('$title', '$kategori_id', '$filename')";

        if (mysqli_query($conn, $sql)) {
            header("Location: gallery-index.php");
            exit;
        } else {
            echo "SQL Error: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">➕ Tambah Gambar Gallery</h3>

        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Gambar</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul" required>
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>

                    <?php while ($row = mysqli_fetch_assoc($kategoriQuery)) { ?>
                        <option value="<?= $row['id']; ?>">
                            <?= $row['nama_kategori']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>


            <!-- Upload Gambar -->
            <div class="mb-3">
                <label class="form-label">Upload Gambar</label>
                <input type="file" name="image" class="form-control" required>
            </div>

            <!-- Tombol -->
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="gallery-index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
