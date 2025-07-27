<?php
include "koneksidatabase.php";

// Ambil gambar dari database
$gambarList = [];
$query = "SELECT * FROM berandatk ORDER BY id DESC";
$result = $db->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $gambarList[] = base64_encode($row['gambar']);
    }
} else {
    die("Query gagal: " . $db->error);
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BERANDA - TK Ceria</title>

    <!-- Bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
  </head>
  <body>
    <!-- MOBILE NAVBAR -->
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
          <ul class="navbar-nav justify-content-center">
            <li class="nav-item"><a class="nav-link" href="beranda.php">🏠 BERANDA</a></li>
            <li class="nav-item"><a class="nav-link" href="berita.php">📰 BERITA</a></li>
            <li class="nav-item"><a class="nav-link" href="jadwal.php">📅 JADWAL KELAS</a></li>
            <li class="nav-item"><a class="nav-link" href="informasi.php">👩‍🏫 INFORMASI GURU</a></li>
            <li class="nav-item"><a class="nav-link" href="tatatertib.php">📋 TATA TERTIB</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">LOGIN</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- MAIN WRAPPER -->
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
        <!-- Welcome Section -->
        <div class="welcome-section d-flex align-items-center mb-4">
          <img
            src="https://cdn-icons-png.flaticon.com/512/201/201634.png"
            alt="Anak"
            style="width: 100px; height: auto; margin-right: 20px;"
          />
          <div class="text h4">SELAMAT DATANG</div>
        </div>

        <!-- Image Gallery -->
        <div class="row g-4 justify-content-center">
          <?php if (count($gambarList) > 0): ?>
            <?php foreach ($gambarList as $img): ?>
              <div class="col-12 col-md-4">
                <div class="image-box shadow p-2 rounded bg-white">
                  <img
                    src="data:image/jpeg;base64,<?= $img ?>"
                    alt="Gambar Beranda"
                    class="img-fluid"
                    style="border-radius: 8px;"
                  />
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-12">
              <p class="text-center text-muted">Tidak ada gambar untuk ditampilkan.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
