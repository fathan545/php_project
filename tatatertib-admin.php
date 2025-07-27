<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "koneksidatabase.php";
$query = "SELECT isi FROM tatatertibtk ORDER BY id DESC LIMIT 1";
$result = $db->query($query);
$data = $result->fetch_assoc();
$isiTataTertib = $data ? $data['isi'] : '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TATA TERTIB - TK CERIA</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <script src="script.js"></script>
</head>

<body>
  <!-- NAVBAR MOBILE -->
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
      <div class="px-3 mt-4">
        <a href="logout.php" class="btn btn-light w-100">LOGOUT</a>
      </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content flex-grow-1">
      <h1 class="fw-bold text-center mb-4">TATA TERTIB</h1>

      <div class="row justify-content-center align-items-center">
        <div class="col-md-7">
          <div id="tatatertibTeks" class="tatatertib-card">
            <!-- Tampilan Biasa -->
            <div id="tampilTeks">
              <?= nl2br(htmlspecialchars($isiTataTertib)) ?>
            </div>

            <!-- Form Edit -->
            <form id="formEdit" action="simpantatatertib.php" method="POST" style="display: none;">
              <textarea name="isi" id="textareaIsi" class="form-control" rows="15"><?= htmlspecialchars($isiTataTertib) ?></textarea>
              <br />
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success btn-sm">💾 Simpan</button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="batalEdit()">Batal</button>
              </div>
            </form>
          </div>
          <br />
          <div class="text-center">
            <button class="btn btn-light btn-sm edit-btn" onclick="editTataTertib()">Edit Teks</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JS Edit Mode -->
  <script>
    function editTataTertib() {
      document.getElementById("tampilTeks").style.display = "none";
      document.getElementById("formEdit").style.display = "block";
    }

    function batalEdit() {
      document.getElementById("formEdit").style.display = "none";
      document.getElementById("tampilTeks").style.display = "block";
    }
  </script>
</body>

</html>
