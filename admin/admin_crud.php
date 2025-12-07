<?php include '../includes/header-admin.php'; ?>
<?php include '../includes/db.php'; ?>

<?php
// CREATE USER
if (isset($_POST['add'])) {
    // Sanitize input
    $username     = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    // Hash password
    $password     = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $query = "INSERT INTO users (username, password, nama_lengkap)
              VALUES ('$username', '$password', '$nama_lengkap')";
    
    if (mysqli_query($conn, $query)) {
        // Successful insertion
        header("Location: admin_crud.php?status=success_add");
    } else {
        // Failed insertion
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

$result = mysqli_query($conn, "SELECT id, username, nama_lengkap FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Admin - Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .container {
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4"></h2>

    <?php
    // Tampilkan pesan status
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success_add') {
            echo '<div class="alert alert-success" role="alert">Admin berhasil ditambahkan!</div>';
        } elseif ($_GET['status'] == 'success_delete') {
            echo '<div class="alert alert-danger" role="alert">Admin berhasil dihapus!</div>';
        } elseif ($_GET['status'] == 'error') {
            $message = isset($_GET['message']) ? $_GET['message'] : 'Terjadi kesalahan.';
            echo '<div class="alert alert-warning" role="alert">Gagal! Pesan: ' . htmlspecialchars($message) . '</div>';
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
                    <th scope="col" style="width: 5%;">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col" style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm me-2">Edit</a>
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php include '../includes/footer-admin.php'; ?>