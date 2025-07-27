<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "koneksidatabase.php";

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
            <li class="nav-item"><a class="nav-link" href="beranda-admin.php">🏠 BERANDA</a></li>
            <li class="nav-item"><a class="nav-link" href="berita-admin.php">📰 BERITA</a></li>
            <li class="nav-item"><a class="nav-link" href="jadwal-admin.php">📅 JADWAL KELAS</a></li>
            <li class="nav-item"><a class="nav-link" href="informasi-admin.php">👩‍🏫 INFORMASI GURU</a></li>
            <li class="nav-item"><a class="nav-link" href="tatatertib-admin.php">📋 TATA TERTIB</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="d-flex">
      <!-- SIDEBAR DESKTOP -->
      <div class="sidebar sidebar-desktop d-none d-md-block">
        <h4 class="text-center py-4">TK CERIA</h4>
        <a href="beranda-admin.php" class="nav-link">🏠 BERANDA</a>
        <a href="berita-admin.php" class="nav-link">📰 BERITA</a>
        <a href="jadwal-admin.php" class="nav-link">📅 JADWAL KELAS</a>
        <a href="informasi-admin.php" class="nav-link">👩‍🏫 INFORMASI GURU</a>
        <a href="tatatertib-admin.php" class="nav-link">📋 TATA TERTIB</a>
        <div class="px-3 mt-4"><a href="logout.php" class="btn btn-light w-100">LOGOUT</a></div>
      </div>

      <!-- MAIN CONTENT -->
      <div class="main-content flex-grow-1">
        <h1 class="fw-bold text-center mb-4">JADWAL KELAS</h1>
        <div class="row justify-content-center">

          <?php
          $hariList = ["senin", "selasa", "rabu", "kamis", "jumat"];
          $labelHari = ["SENIN", "SELASA", "RABU", "KAMIS", "JUMAT"];
          foreach ($hariList as $index => $hari):
            $kegiatan = getJadwal($hari);
          ?>
          <div class="col-md-3 col-sm-6 mb-4">
            <div class="jadwal-box shadow">
              <h5 class="fw-bold text-center"><?= strtoupper($labelHari[$index]) ?></h5>
              <ul id="jadwal-<?= $hari ?>" class="mb-0">
                <?php
                $baris = explode("\n", $kegiatan);
                foreach ($baris as $k) {
                  echo "<li>" . htmlspecialchars($k) . "</li>";
                }
                ?>
              </ul>
            </div>
            <div class="text-center mt-2">
              <form action="simpanjadwal.php" method="POST">
                <input type="hidden" name="hari" value="<?= $hari ?>" />
                <textarea name="kegiatan" class="form-control mb-2" rows="4" placeholder="Masukkan jadwal baru..."><?= htmlspecialchars($kegiatan) ?></textarea>
                <button type="submit" class="btn btn-success btn-sm w-100">Simpan Jadwal</button>
              </form>
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
