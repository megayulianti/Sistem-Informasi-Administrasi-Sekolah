<?php
session_start();
if (isset($_SESSION['nip'])) {
    echo "<script> 
    alert('Anda sudah login');
    window.location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Guru dan Pegawai</title>
  <link href="img/logo/logo.png" rel="icon">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/ruang-admin.min.css" rel="stylesheet">
  <style>
    body {
      background: url('../assets/img/gambar1.png') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container-login {
      max-width: 500px;
      padding: 20px;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .login-form h1 {
      font-weight: 700;
      color: #4e73df;
    }

    .btn-primary {
      background-color: #4e73df;
      border: none;
      padding: 0.5rem 2rem;
      font-size: 1rem;
      transition: background-color 0.3s ease;
      border-radius: 0.5rem;
    }

    .btn-primary:hover {
      background-color: #375a7f;
    }

    .form-control {
      border-radius: 0.5rem;
      padding: 0.75rem 1rem;
      width: 100%;
      max-width: 300px;
      font-size: 1rem;
      margin: 0 auto;
      display: block;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .bg-gradient-login {
      background-color: #f8f9fc;
      border-radius: 1rem;
      padding: 2rem;
    }

    .text-center a {
      color: #1cc88a;
      font-weight: bold;
    }

    .text-center a:hover {
      color: #17a673;
    }

    .btn-secondary {
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div class="container-login">
    <div class="card shadow-sm">
      <div class="card-body px-4 py-4">
        <div class="login-form bg-gradient-login text-center">
          <h1 class="h4 text-gray-900 mb-4">Login Guru dan Pegawai</h1>
          <form class="user" action="proses_login.php" method="POST">
            <div class="form-group">
              <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP" required>
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            </div>
            <div class="form-group">
              <button type="submit" name="login" class="btn btn-primary btn-block w-100">Login</button>
            </div>
          </form>
          <a href="../../index.php" class="btn btn-secondary w-100">← Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../assets/js/ruang-admin.min.js"></script>
</body>
</html>
