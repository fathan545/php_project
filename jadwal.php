<?php
include "koneksidatabase.php";

// Fungsi ambil jadwal dari database
function getJadwal($hari) {
  global $db;
  $stmt = $db->prepare("SELECT kegiatan FROM jadwaltk WHERE hari = ? ORDER BY id DESC LIMIT 1");
  $stmt->bind_param("s", $hari);
  $stmt->execute();
  $stmt->bind_result($jadwal);
  $stmt->fetch();
  $stmt->close();
  return $jadwal ?: "";
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JADWAL KELAS - TK Ceria</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
  </head>
  <body>
    <!-- MOBILE NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-mobile">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">TK CERIA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSidebar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mobileSidebar">
          <ul class="navbar-nav">
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
        <h1 class="fw-bold text-center mb-4">JADWAL KELAS</h1>

        <div class="row justify-content-center">

          <?php
          $hariList = [
            "senin" => "SENIN",
            "selasa" => "SELASA",
            "rabu" => "RABU",
            "kamis" => "KAMIS",
            "jumat" => "JUMAT"
          ];
          foreach ($hariList as $key => $label):
          ?>
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="jadwal-box shadow">
              <h5 class="fw-bold text-center"><?= $label ?></h5>
              <ul class="mb-0">
                <?php
                $kegiatan = getJadwal($key);
                if ($kegiatan) {
                  foreach (explode("\n", $kegiatan) as $item) {
                    echo "<li>" . htmlspecialchars($item) . "</li>";
                  }
                } else {
                  echo "<li><em>Belum ada jadwal.</em></li>";
                }
                ?>
              </ul>
            </div>
          </div>
          <?php endforeach; ?>

        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
