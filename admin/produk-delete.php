<?php include '../includes/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT gambar FROM produk WHERE id=$id")->fetch_assoc();

if (file_exists("../uploads/" . $data['gambar'])) {
  unlink("../uploads/" . $data['gambar']);
}

$conn->query("DELETE FROM produk WHERE id=$id");

header("Location: produk-index.php");
exit;
