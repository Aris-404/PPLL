<?php
//session_start();
include '../includes/db.php';

// Jika sudah login, langsung arahkan ke dashboard
if (isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 25px;
            border-radius: 12px;
            background: white;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        .login-title {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
        }
    </style>
</head>

<body>

<div class="login-card">
    <h3 class="text-center login-title">Login Admin</h3>
    
    <?php
    // Tampilkan pesan error jika ada
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger text-center">'.htmlspecialchars($_GET['error']).'</div>';
    }
    ?>

    <form action="login_proses.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-login">Login</button>
    </form>

</div>

</body>
</html>
