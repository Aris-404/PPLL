<?php include '../includes/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT gambar FROM service WHERE id=$id")->fetch_assoc();

// hapus file gambar
if (file_exists("uploads/" . $data['gambar'])) {
  unlink("uploads/" . $data['gambar']);
}

// hapus database
$conn->query("DELETE FROM service WHERE id=$id");

header("Location: service-index.php");
exit;
