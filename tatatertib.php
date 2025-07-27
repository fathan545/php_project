<?php
include "koneksidatabase.php";
$query = "SELECT isi FROM tatatertibtk ORDER BY id DESC LIMIT 1";
$result = $db->query($query);
$data = $result->fetch_assoc();
$isiTataTertib = $data ? nl2br(htmlspecialchars($data['isi'])) : '<p><em>Belum ada tata tertib tersedia.</em></p>';
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TATA TERTIB - TK CERIA</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
  </head>
  <body>
    <!-- NAVBAR MOBILE -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-mobile">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">TK CERIA</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mobileSidebar"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mobileSidebar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="beranda.php">🏠 BERANDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="berita.php">📰 BERITA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="jadwal.php">📅 JADWAL KELAS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="informasi.php">👩‍🏫 INFORMASI GURU</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tatatertib.php">📋 TATA TERTIB</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">LOGIN</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="d-flex">
      <!-- SIDEBAR DESKTOP -->
      <div class="sidebar sidebar-desktop d-none d-md-block">
        <h4 class="text-center py-4">TK CERIA</h4>
        <a href="beranda.php" class="nav-link">🏠 BERANDA</a>
        <a href="berita.php" class="nav-link">📰 BERITA</a>
        <a href="jadwal.php" class="nav-link">📅 JADWAL KELAS</a>
        <a href="informasi.php" class="nav-link">👩‍🏫 INFORMASI GURU</a>
        <a href="tatatertib.php" class="nav-link">📋 TATA TERTIB</a>
        <div class="px-3 mt-4">
          <a href="login.php" class="btn btn-light w-100">LOGIN</a>
        </div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="main-content flex-grow-1">
        <h1 class="fw-bold text-center mb-4">TATA TERTIB</h1>

        <div class="row justify-content-center align-items-center">
          <div class="col-md-7">
            <div class="tatatertib-card">
              <?= $isiTataTertib ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
