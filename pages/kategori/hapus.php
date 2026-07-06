<?php
include 'config/koneksi.php';

$id = intval($_GET['id']);

mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = $id");

header("Location: index.php?status=hapus");
exit;
?>
