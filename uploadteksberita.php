<?php
include "koneksidatabase.php";

if (isset($_POST['upload'])) {
    $judul = mysqli_real_escape_string($db, $_POST['judul']);
    $isi = mysqli_real_escape_string($db, $_POST['isi']);

    $cek = mysqli_query($db, "SELECT * FROM beritatk");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($db, "UPDATE beritatk SET judul='$judul', isi='$isi'");
    } else {
        mysqli_query($db, "INSERT INTO beritatk (judul, isi) VALUES ('$judul', '$isi')");
    }

    echo "<script>alert('Teks berita berhasil disimpan!'); window.location='berita-admin.php';</script>";
}
?>
