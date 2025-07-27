<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "koneksidatabase.php";

$sql = "SELECT * FROM infogurutk ORDER BY id DESC";
$result = $db->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>INFORMASI GURU - TK Ceria</title>

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
      <div class="main-content flex-grow-1 p-4">
        <h1 class="fw-bold text-center mb-5">INFORMASI GURU</h1>

        <!-- List Guru -->
        <div class="row justify-content-center">
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <div class="col-12 col-md-4 col-lg-3 mb-4 text-center">
                <div class="card p-3 h-100 shadow-sm">
                  <img
                    src="data:image/jpeg;base64,<?= base64_encode($row['foto']) ?>"
                    alt="Foto Guru"
                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; margin:auto;"
                  />
                  <h5 class="mt-3"><?= htmlspecialchars($row['nama']) ?></h5>
                  <p><small><strong>Keahlian:</strong> <?= htmlspecialchars($row['keahlian']) ?></small></p>
                  <form action="hapusguru.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                    <button type="submit" class="btn btn-danger btn-sm mt-2">Hapus</button>
                  </form>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else: ?>
            <div class="text-center mt-5">
              <p class="text-muted">Belum ada data guru yang ditambahkan.</p>
            </div>
          <?php endif; ?>
        </div>

        <!-- Form Tambah Guru -->
        <div class="container mt-5">
          <h4>Tambah Informasi Guru</h4>
          <form action="simpaninfoguru.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Guru</label>
              <input type="text" class="form-control" id="nama" name="nama" required />
            </div>
            <div class="mb-3">
              <label for="keahlian" class="form-label">Keahlian Guru</label>
              <textarea class="form-control" id="keahlian" name="keahlian" rows="2" required></textarea>
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Upload Foto Guru</label>
              <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required />
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>