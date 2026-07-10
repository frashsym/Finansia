<?php
require_once '../../config/koneksi.php';
$base = "../../";

$query = "SELECT p.*, k.nama_kategori
          FROM pengeluaran p
          LEFT JOIN kategori k ON p.id_kategori = k.id_kategori
          ORDER BY p.tanggal DESC";
$data = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengeluaran - Catatan Keuangan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../../config/navbar.php'; ?>

<div class="container">
    <h3 class="page-title">Data Pengeluaran</h3>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'sukses'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data pengeluaran berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['status'] == 'gagal'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Terjadi kesalahan, data gagal disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php elseif ($_GET['status'] == 'edit'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data pengeluaran berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['status'] == 'hapus'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data pengeluaran berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Pengeluaran</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                    <td class="text-danger">Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_pengeluaran'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_pengeluaran'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
