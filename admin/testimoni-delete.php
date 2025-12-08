<?php include '../includes/db.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM testimoni WHERE id=$id")->fetch_assoc();

$conn->query("DELETE FROM testimoni WHERE id=$id");

header("Location: testimoni-index.php");
exit;
