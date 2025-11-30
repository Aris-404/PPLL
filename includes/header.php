<?php
// Cek session jika dipakai login
// session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap CDN (optional, boleh hapus jika tidak pakai) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">Admin Panel</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="index.php" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="produk.php" class="nav-link">Produk</a></li>
            <li class="nav-item"><a href="tim.php" class="nav-link">Tim</a></li>
            <li class="nav-item"><a href="testimoni.php" class="nav-link">Testimoni</a></li>
            <li class="nav-item"><a href="./admin/gallery-index.php" class="nav-link">Gallery</a></li>
            <li class="nav-item"><a href="setting.php" class="nav-link">Setting</a></li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
