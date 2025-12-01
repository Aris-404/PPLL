<?php
include 'koneksi.php';

// CREATE USER
if (isset($_POST['add'])) {
    $username     = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password, nama_lengkap)
              VALUES ('$username', '$password', '$nama_lengkap')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: admin_crud.php?status=success_add");
    } else {
        header("Location: admin_crud.php?status=error&message=" . urlencode(mysqli_error($conn)));
    }
    exit;
}

// DELETE USER
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $query = "DELETE FROM users WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: admin_crud.php?status=success_delete");
    } else {
        header("Location: admin_crud.php?status=error&message=" . urlencode(mysqli_error($conn)));
    }
    exit;
}

// Ambil data user
$result = mysqli_query($conn, "SELECT id, username, nama_lengkap FROM users ORDER BY id DESC");
?>

<?php
// session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Admin - Users</title>

    <!-- CSS HEADER -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS CRUD -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    main {
        flex: 1;
    }
</style>

</head>

<body>

<!-- =========== NAVBAR HEADER =========== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 mb-4">
    <a class="navbar-brand" href="#">Admin Panel</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="../index-admin.php" class="nav-link">Dashboard</a></li>
            <li class="nav-item"><a href="../produk.php" class="nav-link">Produk</a></li>
            <li class="nav-item"><a href="../tim.php" class="nav-link">Tim</a></li>
            <li class="nav-item"><a href="../testimoni.php" class="nav-link">Testimoni</a></li>
            <li class="nav-item"><a href="../admin/gallery-index.php" class="nav-link">Gallery</a></li>
            <li class="nav-item"><a href="../setting.php" class="nav-link">Setting</a></li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item"><a href="logout.php" class="nav-link text-danger">Logout</a></li>
        </ul>
    </div>
</nav>
<!-- =========== END NAVBAR HEADER =========== -->

<!-- GANTI DIV → MAIN -->
<main class="container">
    <h2 class="mb-4"></h2>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success_add') {
            echo '<div class="alert alert-success">Admin berhasil ditambahkan!</div>';
        } elseif ($_GET['status'] == 'success_delete') {
            echo '<div class="alert alert-danger">Admin berhasil dihapus!</div>';
        } elseif ($_GET['status'] == 'error') {
            $message = isset($_GET['message']) ? $_GET['message'] : 'Terjadi kesalahan.';
            echo '<div class="alert alert-warning">Gagal! Pesan: ' . htmlspecialchars($message) . '</div>';
        }
    }
    ?>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Admin Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <button class="btn btn-success" name="add" type="submit">Tambah Admin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <h3 class="mt-5 mb-3">Daftar Admin</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a onclick="return confirm('Yakin hapus admin ini?');"
                           href="admin_crud.php?delete=<?= $row['id']; ?>" 
                           class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>

                <?php if (mysqli_num_rows($result) == 0): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data admin.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
<!-- END MAIN -->


<footer class="bg-dark text-white text-center p-3 mt-5">
    <small>© <?php echo date('Y'); ?> - Dashboard Admin | PHP Native</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
