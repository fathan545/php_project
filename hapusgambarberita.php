<?php
include "koneksidatabase.php";

$query = mysqli_query($db, "SELECT gambar FROM beritatk LIMIT 1");
$data = mysqli_fetch_assoc($query);

if ($data && file_exists($data['gambar'])) {
    unlink($data['gambar']);
}

mysqli_query($db, "UPDATE beritatk SET gambar=''");

echo "<script>alert('Gambar berhasil dihapus!'); window.location='berita-admin.php';</script>";
?>