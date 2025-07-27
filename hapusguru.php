<?php
include "koneksidatabase.php";

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM infogurutk WHERE id = $id";

    if ($db->query($sql)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='informasi-admin.php';</script>";
    } else {
        echo "Gagal menghapus data: " . $db->error;
    }
}
?>
