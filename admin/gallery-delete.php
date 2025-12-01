<?php
include "./includes/db.php";

$id = $_GET['id'];

$q = mysqli_query($conn, "SELECT image FROM gallery WHERE id=$id");
$d = mysqli_fetch_assoc($q);
unlink("../upload/" . $d['image']);

mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");

header("Location: index.php");
