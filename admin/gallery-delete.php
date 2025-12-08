<?php
include "../includes/db.php"; // path yang benar

if (!isset($_GET['id'])) {
    header("Location: gallery-index.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil nama file gambar
$q = mysqli_query($conn, "SELECT gambar FROM gallery WHERE id=$id");
$d = mysqli_fetch_assoc($q);

// Hapus file gambar jika ada
if (!empty($d['gambar']) && file_exists("../upload/" . $d['gambar'])) {
    unlink("../upload/" . $d['gambar']);
}

// Hapus data di database
mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");

// Redirect kembali ke halaman gallery
header("Location: gallery-index.php");
exit;
