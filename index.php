<?php
require_once 'config/koneksi.php';
$base = "";

// Ambil total pemasukan
$query1 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM pemasukan");
$row1 = mysqli_fetch_assoc($query1);
$total_pemasukan = $row1['total'] ?? 0;

// Ambil total pengeluaran
$query2 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS total FROM pengeluaran");
$row2 = mysqli_fetch_assoc($query2);
$total_pengeluaran = $row2['total'] ?? 0;

// Hitung saldo
$saldo = $total_pemasukan - $total_pengeluaran;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Catatan Keuangan Pribadi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<?php include 'config/navbar.php'; ?>

<div class="container">
    <h3 class="page-title">Dashboard</h3>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card card-dashboard card-pemasukan">
                <div class="card-body">
                    <h6 class="text-muted">Total Pemasukan</h6>
                    <h3 class="text-success">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-dashboard card-pengeluaran">
                <div class="card-body">
                    <h6 class="text-muted">Total Pengeluaran</h6>
                    <h3 class="text-danger">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-dashboard card-saldo">
                <div class="card-body">
                    <h6 class="text-muted">Saldo</h6>
                    <h3 class="text-primary">Rp <?= number_format($saldo, 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-md-6">
            <div class="card-chart">
                <h6 class="mb-3">Perbandingan Pemasukan vs Pengeluaran</h6>
                <canvas id="chartKeuangan"></canvas>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-5 text-center">
        <a href="pages/pemasukan/index.php" class="btn btn-success me-2">Lihat Pemasukan</a>
        <a href="pages/pengeluaran/index.php" class="btn btn-danger me-2">Lihat Pengeluaran</a>
        <a href="pages/kategori/index.php" class="btn btn-primary">Kelola Kategori</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('chartKeuangan');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Jumlah (Rp)',
                data: [<?= $total_pemasukan ?>, <?= $total_pengeluaran ?>],
                backgroundColor: ['#198754', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
</body>
</html>
