<?php
include "koneksidatabase.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Hapus gambar dari database
    $hapus = $db->query("DELETE FROM berandatk WHERE id = $id");

    if ($hapus) {
        header("Location: beranda-admin.php?success=hapus");
    } else {
        header("Location: beranda-admin.php?error=db");
    }
    exit();
} else {
    // Jika akses langsung tanpa POST
    header("Location: beranda-admin.php?error=invalid");
    exit();
}
