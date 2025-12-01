<?php include '../includes/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT foto FROM tim WHERE id=$id")->fetch_assoc();

if (file_exists("../uploads/" . $data['foto'])) {
    unlink("../uploads/" . $data['foto']);
}

$conn->query("DELETE FROM tim WHERE id=$id");

header("Location: about-index.php");
exit;
