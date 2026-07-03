<?php
include 'config/koneksi.php';

if ($koneksi) {
    echo "Koneksi database BERHASIL 🚀";
} else {
    echo "Koneksi database GAGAL ❌";
}
?>