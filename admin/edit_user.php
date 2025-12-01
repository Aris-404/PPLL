<?php
include 'koneksi.php';

$id = $_GET['id'];

// Ambil Data User
$data = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($data);

// Proses Update
if (isset($_POST['update'])) {
    $username     = $_POST['username'];
    $nama_lengkap = $_POST['nama_lengkap'];

    if ($_POST['password'] != "") {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $query = "UPDATE users SET 
                    username='$username',
                    nama_lengkap='$nama_lengkap',
                    password='$password'
                  WHERE id=$id";
    } else {
        $query = "UPDATE users SET 
                    username='$username',
                    nama_lengkap='$nama_lengkap'
                  WHERE id=$id";
    }

    mysqli_query($conn, $query);
    header("Location: admin_crud.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
</head>
<body>

<h2>Edit Admin</h2>

<form method="POST">
    <label>Username</label><br>
    <input type="text" name="username" value="<?= $user['username']; ?>" required><br><br>

    <label>Nama Lengkap</label><br>
    <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>"><br><br>

    <label>Password Baru (opsional)</label><br>
    <input type="password" name="password" placeholder="Kosongkan jika tidak ganti"><br><br>

    <button name="update">Simpan Perubahan</button>
</form>

</body>
</html>
