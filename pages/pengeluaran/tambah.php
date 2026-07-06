<?php
require_once '../../config/koneksi.php';
$base = "../../";

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE tipe = 'pengeluaran' ORDER BY nama_kategori");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jumlah = intval($_POST['jumlah']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $id_kategori = intval($_POST['id_kategori']);

    $query = "INSERT INTO pengeluaran (tanggal, jumlah, keterangan, id_kategori)
              VALUES ('$tanggal', $jumlah, '$keterangan', $id_kategori)";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengeluaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../../config/navbar.php'; ?>

<div class="container">
    <h3 class="page-title">Tambah Pengeluaran</h3>

    <div class="card card-dashboard">
        <div class="card-body">
            <form method="POST" action="tambah.php">
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php while ($k = mysqli_fetch_assoc($kategori)): ?>
                            <option value="<?= $k['id_kategori'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                        <?php endwhile; ?>
                    </select>
                    <?php if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori WHERE tipe='pengeluaran'")) == 0): ?>
                        <small class="text-danger">Belum ada kategori pengeluaran, silakan tambah di menu Kategori dulu.</small>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah (Rp)</label>
                    <input type="number" name="jumlah" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
