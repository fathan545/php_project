<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
include "koneksidatabase.php";

$msg = "";
$totalGambar = 0;

// Hitung jumlah gambar di database
$cekJumlah = $db->query("SELECT COUNT(*) as total FROM berandatk");
$dataJumlah = $cekJumlah->fetch_assoc();
$totalGambar = $dataJumlah['total'];

// Proses upload baru (jika jumlah gambar belum 3)
if (isset($_POST['upload'])) {
    if ($totalGambar >= 3) {
        header("Location: beranda-admin.php?error=max");
        exit();
    }

    if ($_FILES['gambar']['size'] > 10 * 1024 * 1024) {
        header("Location: beranda-admin.php?error=size");
        exit();
    } elseif (strpos(mime_content_type($_FILES['gambar']['tmp_name']), "image") !== 0) {
        header("Location: beranda-admin.php?error=type");
        exit();
    } else {
        $nama_file = $_FILES['gambar']['name'];
        $gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
        // Mengecek apakah gambar sudah ada di database
        $cekGambar = $db->query("SELECT * FROM berandatk WHERE nama_file = '$nama_file'");
        if ($cekGambar->num_rows > 0) {
            header("Location: beranda-admin.php?error=duplicate");
            exit();
        }
        $db->query("INSERT INTO berandatk (nama_file, gambar) VALUES ('$nama_file', '$gambar')");
        header("Location: beranda-admin.php?success=1");
        exit();
    }
}

// Ambil maksimal 3 gambar terbaru
$query = "SELECT * FROM berandatk ORDER BY id DESC LIMIT 3";
$result = $db->query($query);
$gambarList = [];
while ($row = $result->fetch_assoc()) {
    $gambarList[] = [
        'id' => $row['id'],
        'data' => base64_encode($row['gambar']),
        'nama_file' => $row['nama_file']
    ];
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
              <a class="nav-link" href="tatatertib.php">📋 TATA TERTIB</a>
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
      <div class="main-content flex-grow-1 text-center">
        <!-- Welcome Section -->
        <div class="welcome-section d-flex align-items-center mb-4">
          <img
            src="https://cdn-icons-png.flaticon.com/512/201/201634.png"
            alt="Anak"
          />
          <div class="text">SELAMAT DATANG</div>
        </div>

        <!-- Pesan -->
        <?php if (isset($_GET['success'])): ?>
          <p class="message">Gambar berhasil diupload.</p>
        <?php elseif (isset($_GET['error'])): ?>
          <?php
            $error = $_GET['error'];
            $pesan = [
              "max" => "Maksimal 3 gambar saja! Silakan hapus gambar lama.",
              "size" => "Ukuran gambar maksimal 2MB!",
              "type" => "File bukan gambar!",
              "duplicate" => "Gambar sudah ada di database!"
            ];
          ?>
          <p class="error"><?= $pesan[$error] ?? "Terjadi kesalahan saat upload." ?></p>
        <?php endif; ?>

        <!-- Upload Form -->
        <?php if ($totalGambar < 3): ?>
          <div class="upload-form">
            <form method="POST" enctype="multipart/form-data">
              <input type="file" name="gambar" required>
              <button type="submit" name="upload">Upload Gambar</button>
            </form>
          </div>
        <?php endif; ?>

        <!-- Gambar yang ditampilkan -->
        <div class="row g-4">
          <?php if (empty($gambarList)): ?>
            <p class="text-muted">Tidak ada gambar yang diupload.</p>
          <?php else: ?>
            <?php foreach ($gambarList as $img): ?>
              <div class="col-12 col-md-4">
                <div class="image-box">
                  <img
                    src="data:image/jpeg;base64,<?= $img['data'] ?>"
                    alt="<?= $img['nama_file'] ?>"
                    class="img-fluid shadow-sm"
                  />
                </div>
                <br />
                <form method="POST" action="hapusgambaradmin.php" onsubmit="return confirm('Yakin ingin hapus gambar ini?')">
                  <input type="hidden" name="id" value="<?= $img['id'] ?>">
                  <button type="submit" name="hapus" class="btn btn-light">Hapus</button>
                </form>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
