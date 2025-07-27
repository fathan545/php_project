<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "koneksidatabase.php";

// Proses simpan berita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_berita'])) {
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];

  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
    $tipe = $_FILES['gambar']['type'];
    $nama = $_FILES['gambar']['name'];

    $query = "INSERT INTO beritatk (judul, isi, gambar, tipe_gambar, nama_file) 
              VALUES ('$judul', '$isi', '$gambar', '$tipe', '$nama')";
    $db->query($query);
  } else {
    $query = "INSERT INTO beritatk (judul, isi) 
              VALUES ('$judul', '$isi')";
    $db->query($query);
  }
}

// Proses hapus berita
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $db->query("DELETE FROM beritatk WHERE id = $id");
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BERITA - TK Ceria</title>

    <!-- Bootstrap CSS -->
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
              <a class="nav-link" href="beranda-admin.php">🏠 BERANDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="berita-admin.php">📰 BERITA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="jadwal-admin.php">📅 JADWAL KELAS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="informasi-admin.php"
                >👩‍🏫 INFORMASI GURU</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tatatertib-admin.php"
                >📋 TATA TERTIB</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">LOGOUT</a>
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
        <h1 class="fw-bold mb-4 text-center">BERITA</h1>

        <!-- FORM TAMBAH BERITA -->
        <div class="container mb-5">
          <h4 class="text-center mb-3">Tambah Berita Baru</h4>
          <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            <div class="mb-3">
              <label for="judul" class="form-label">Judul Berita</label>
              <input type="text" class="form-control" id="judul" name="judul" required />
            </div>
            <div class="mb-3">
              <label for="isi" class="form-label">Isi Berita</label>
              <textarea class="form-control" id="isi" name="isi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="gambar" class="form-label">Upload Gambar (Opsional)</label>
              <input class="form-control" type="file" name="gambar" accept="image/*" />
            </div>
            <button type="submit" name="submit_berita" class="btn btn-primary w-100">Simpan Berita</button>
          </form>
        </div>

        <!-- DAFTAR BERITA -->
        <div class="container mb-5">
          <h4 class="text-center mb-3">Daftar Berita</h4>
          <div class="row">
            <?php
            $result = $db->query("SELECT * FROM beritatk ORDER BY created_at DESC");
            while ($row = $result->fetch_assoc()):
            ?>
            <div class="col-md-3 mb-2">
              <div class="card shadow-sm h-100">
                <?php if ($row['gambar']): ?>
                <img
                  src="data:<?php echo $row['tipe_gambar']; ?>;base64,<?php echo base64_encode($row['gambar']); ?>"
                  class="card-img-top"
                  alt="Gambar Berita"
                />
                <?php endif; ?>
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($row['judul']); ?></h5>
                  <p class="card-text"><?php echo htmlspecialchars($row['isi']); ?></p>
                  <a href="?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Hapus berita ini?')" class="btn btn-danger btn-sm">Hapus</a>
                </div>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
