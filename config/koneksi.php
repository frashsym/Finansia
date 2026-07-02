<?php
/**
 * File koneksi database menggunakan mysqli
 * Sesuaikan $user dan $pass jika perlu (default XAMPP/Laragon: root, tanpa password)
 */

$host = "localhost";
$user = "root";
$pass = "";
$db   = "keuangan";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset biar aman untuk teks
mysqli_set_charset($koneksi, "utf8mb4");
?>
