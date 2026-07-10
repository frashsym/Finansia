<?php
require_once '../../config/koneksi.php';
$base = "../../";

$id = intval($_GET['id']);

$query = mysqli_query($koneksi, "SELECT * FROM pengeluaran WHERE id_pengeluaran = $id");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    header("Location: index.php?status=gagal");
    exit;
}

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE tipe = 'pengeluaran' ORDER BY nama_kategori");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jumlah = intval($_POST['jumlah']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $id_kategori = intval($_POST['id_kategori']);

    $updateQuery = "UPDATE pengeluaran
                     SET tanggal = '$tanggal', jumlah = $jumlah, keterangan = '$keterangan', id_kategori = $id_kategori
                     WHERE id_pengeluaran = $id";

    if (mysqli_query($koneksi, $updateQuery)) {
        header("Location: index.php?status=sukses");
        exit;
    } else {
        header("Location: index.php?status=gagal");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengeluaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../../config/navbar.php'; ?>

<div class="container">
    <h3 class="page-title">Edit Pengeluaran</h3>

    <div class="card card-dashboard">
        <div class="card-body">
            <form method="POST" action="edit.php?id=<?= $id ?>">
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-select" required>
                        <?php while ($k = mysqli_fetch_assoc($kategori)): ?>
                            <option value="<?= $k['id_kategori'] ?>" <?= $k['id_kategori'] == $row['id_kategori'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['nama_kategori']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah (Rp)</label>
                    <input type="number" name="jumlah" class="form-control" min="0" value="<?= $row['jumlah'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($row['keterangan']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
