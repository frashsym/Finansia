<?php
require_once '../../config/koneksi.php';

$id = intval($_GET['id']);

mysqli_query($koneksi, "DELETE FROM pemasukan WHERE id_pemasukan = $id");

header("Location: index.php");
exit;
?>
