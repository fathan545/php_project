<?php
include "koneksidatabase.php";

if (isset($_POST['upload'])) {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $folder = "gambar/berita/";

    if ($_FILES['gambar']['size'] > 10 * 1024 * 1024) {
        echo "<script>alert('Ukuran gambar maksimal 10MB!'); window.history.back();</script>";
        exit;
    }

    $tipe = mime_content_type($tmp);
    if (strpos($tipe, "image") !== 0) {
        echo "<script>alert('File yang diupload bukan gambar!'); window.history.back();</script>";
        exit;
    }

    if (!file_exists($folder)) {
        mkdir($folder, 0755, true);
    }

    $pathBaru = $folder . time() . "-" . basename($gambar);
    move_uploaded_file($tmp, $pathBaru);

    $cek = mysqli_query($db, "SELECT * FROM beritatk");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($db, "UPDATE beritatk SET gambar='$pathBaru'");
    } else {
        mysqli_query($db, "INSERT INTO beritatk (gambar) VALUES ('$pathBaru')");
    }

    echo "<script>alert('Gambar berhasil diupload!'); window.location='berita-admin.php';</script>";
}
?>
