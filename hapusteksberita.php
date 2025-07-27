<?php
include "koneksidatabase.php";

mysqli_query($db, "UPDATE beritatk SET judul='', isi=''");

echo "<script>alert('Teks berita berhasil dihapus!'); window.location='berita-admin.php';</script>";
?>
