<?php
include "koneksidatabase.php";
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BERITA - TK Ceria</title>
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
        <h1 class="fw-bold mb-4 text-center">BERITA</h1>

        <div class="container">
          <div class="row justify-content-center">
            <?php
              $query = mysqli_query($db, "SELECT * FROM beritatk ORDER BY id DESC");
              while ($row = mysqli_fetch_assoc($query)) {
                  $gambarSrc = '';

                  // Periksa apakah gambar tidak kosong/null
                  if (!empty($row['gambar'])) {
                      // Coba deteksi MIME type dari binary data
                      $finfo = new finfo(FILEINFO_MIME_TYPE);
                      $mime = $finfo->buffer($row['gambar']);
                      $gambarSrc = 'data:' . $mime . ';base64,' . base64_encode($row['gambar']);
                  }
            ?>
            <div class="col-md-10 mb-4">
              <div class="card shadow-sm">
                <div class="row g-0">
                  <div class="col-md-4">
                    <?php if (!empty($gambarSrc)): ?>
                    <img
                      src="<?php echo $gambarSrc; ?>"
                      alt="<?php echo htmlspecialchars($row['judul']); ?>"
                      class="img-fluid rounded-start"
                      style="height: 100%; object-fit: cover;"
                    />
                    <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light text-center" style="height:100%;">
                      <p class="text-muted p-2">Tidak ada gambar</p>
                    </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['judul']); ?></h5>
                      <p class="card-text"><?php echo nl2br(htmlspecialchars($row['isi'])); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
