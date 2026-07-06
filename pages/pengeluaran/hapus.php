<?php
include 'config/koneksi.php';

$id = intval($_GET['id']);

mysqli_query($koneksi, "DELETE FROM pengeluaran WHERE id_pengeluaran = $id");

header("Location: index.php?status=hapus");
exit;
?>
