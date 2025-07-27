<?php
include "koneksidatabase.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $isi = $_POST["isi"];
  $query = "INSERT INTO tatatertibtk (isi) VALUES (?)";
  $stmt = $db->prepare($query);
  $stmt->bind_param("s", $isi);

  if ($stmt->execute()) {
    header("Location: tatatertib-admin.php");
    exit();
  } else {
    echo "Gagal menyimpan data: " . $stmt->error;
  }
}
?>
