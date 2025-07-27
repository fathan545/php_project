<?php
session_start();

include 'koneksidatabase.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // Query untuk cek login
  $query = "SELECT * FROM admintk WHERE username='$username' AND password='$password'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) == 1) {
    // Login berhasil
    $_SESSION['username'] = $username;
    $_SESSION['admin_logged_in'] = true; // <--- TAMBAHKAN INI
    session_regenerate_id(true); // Mencegah session fixation

    header("Location: beranda-admin.php");
    exit();
  } else {
    // Login gagal
    $error = "Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin - TK Ceria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<style>
  body {
    background-color: #cceeff;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .login-card {
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    max-width: 900px;
    width: 100%;
  }
  .login-image {
    background-color: #f0f8ff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
  }
  .login-image img {
    width: 80%;
    max-width: 220px;
  }
  .login-form {
    background-color: #00aaff;
    color: white;
    padding: 2rem;
  }
  .login-form h2 {
    font-weight: bold;
    margin-bottom: 1.5rem;
  }
  .form-control {
    border-radius: 30px;
  }
  .btn-custom {
    border-radius: 30px;
  }
  @media (max-width: 768px) {
    .login-card {
      flex-direction: column;
    }
    .login-image {
      padding: 1rem;
    }
  }
</style>
<body>
  <div class="d-flex login-card flex-md-row flex-column">
    <div class="col-md-6 login-image">
      <img src="https://ps.w.org/login-customizer/assets/icon-128x128.png?rev=2455454" alt="Login Image" />
    </div>
    <div class="col-md-6 login-form text-center">
      <h2>Selamat Datang</h2>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>
      <form method="post">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required />
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required />
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success btn-custom">Login</button>
          <a href="beranda.php" class="btn btn-danger btn-custom">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
