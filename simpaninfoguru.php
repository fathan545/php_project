<?php
include "koneksidatabase.php";

$nama = $_POST['nama'];
$keahlian = $_POST['keahlian'];

if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    $filename = $_FILES['foto']['name'];

    $sql = "INSERT INTO infogurutk (nama, keahlian, foto, filename) 
            VALUES ('$nama', '$keahlian', '$foto', '$filename')";

    if ($db->query($sql)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='informasi-admin.php';</script>";
    } else {
        echo "Gagal menyimpan data: " . $db->error;
    }
} else {
    echo "Upload gambar gagal!";
}
?>
