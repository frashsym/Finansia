<?php
include 'config/koneksi.php';
$base = "../../";

$data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY tipe, nama_kategori");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori - Catatan Keuangan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../../config/navbar.php'; ?>

<div class="container">
    <h3 class="page-title">Data Kategori</h3>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'sukses'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data kategori berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['status'] == 'gagal'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Terjadi kesalahan, data gagal disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['status'] == 'hapus'): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data kategori berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                    <td>
                        <?php if ($row['tipe'] == 'pemasukan'): ?>
                            <span class="badge bg-success">Pemasukan</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Pengeluaran</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_kategori'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="hapus.php?id=<?= $row['id_kategori'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
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
