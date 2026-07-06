<?php
require_once '../../config/koneksi.php';
$base = "../../";

$id = intval($_GET['id']);

// Ambil data kategori berdasarkan id
$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = $id");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
    $tipe = mysqli_real_escape_string($koneksi, $_POST['tipe']);

    $updateQuery = "UPDATE kategori SET nama_kategori = '$nama', tipe = '$tipe' WHERE id_kategori = $id";

    if (mysqli_query($koneksi, $updateQuery)) {
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
    <title>Edit Kategori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include '../../config/navbar.php'; ?>

<div class="container">
    <h3 class="page-title">Edit Kategori</h3>

    <div class="card card-dashboard">
        <div class="card-body">
            <form method="POST" action="edit.php?id=<?= $id ?>">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control"
                           value="<?= htmlspecialchars($row['nama_kategori']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipe</label>
                    <select name="tipe" class="form-select" required>
                        <option value="pemasukan" <?= $row['tipe'] == 'pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                        <option value="pengeluaran" <?= $row['tipe'] == 'pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                    </select>
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
