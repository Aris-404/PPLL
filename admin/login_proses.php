<?php
session_start();
include '../includes/db.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // verifikasi password
    if (password_verify($password, $row['password'])) {

        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        header("Location: index.php");
        exit;

    } else {
        header("Location: login.php?error=Password salah!");
        exit;
    }
} else {
    header("Location: login.php?error=Username tidak ditemukan!");
    exit;
}
?>
