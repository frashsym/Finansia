<?php
require_once '../../config/koneksi.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_pengeluaran.xls");

$query = "SELECT p.*, k.nama_kategori
          FROM pengeluaran p
          LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
          ORDER BY p.tanggal DESC";
$data = mysqli_query($koneksi, $query);
?>
<table border="1">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kategori</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
    </tr>
    <?php $no = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= htmlspecialchars($row['nama_kategori'] ?? '-') ?></td>
        <td><?= htmlspecialchars($row['keterangan']) ?></td>
        <td><?= $row['jumlah'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
