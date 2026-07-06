<?php
/**
 * Navbar bersama, di-include di semua halaman.
 * Variabel $base harus sudah didefinisikan sebelum include file ini,
 * berisi path relatif menuju folder root project.
 * Contoh: "" untuk index.php di root, "../../" untuk halaman di dalam pages/xxx/
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= $base ?>index.php">💰 Catatan Keuangan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>pages/pemasukan/index.php">Pemasukan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>pages/pengeluaran/index.php">Pengeluaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>pages/kategori/index.php">Kategori</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
