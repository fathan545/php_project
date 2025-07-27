<?php
include "koneksidatabase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $hari = $_POST['hari'];
  $kegiatan = $_POST['kegiatan'];

  // Cek apakah sudah ada jadwal untuk hari ini → update saja
  $cek = $db->prepare("SELECT id FROM jadwaltk WHERE hari = ?");
  $cek->bind_param("s", $hari);
  $cek->execute();
  $cek->store_result();

  if ($cek->num_rows > 0) {
    // Update
    $stmt = $db->prepare("UPDATE jadwaltk SET kegiatan = ?, waktu = CURRENT_TIMESTAMP WHERE hari = ?");
    $stmt->bind_param("ss", $kegiatan, $hari);
  } else {
    // Insert baru
    $stmt = $db->prepare("INSERT INTO jadwaltk (hari, kegiatan) VALUES (?, ?)");
    $stmt->bind_param("ss", $hari, $kegiatan);
  }

  $stmt->execute();
  header("Location: jadwal-admin.php");
  exit();
}
?>
