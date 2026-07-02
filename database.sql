-- =========================================================
-- Database: keuangan_pribadi
-- Aplikasi Catat Keuangan Pribadi (Pemasukan & Pengeluaran)
-- =========================================================

CREATE DATABASE IF NOT EXISTS keuangan_pribadi;
USE keuangan_pribadi;

-- =========================================================
-- Tabel: kategori
-- =========================================================
CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    tipe ENUM('pemasukan', 'pengeluaran') NOT NULL
);

-- =========================================================
-- Tabel: pemasukan
-- =========================================================
CREATE TABLE pemasukan (
    id_pemasukan INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    jumlah INT NOT NULL,
    keterangan TEXT,
    id_kategori INT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- =========================================================
-- Tabel: pengeluaran
-- =========================================================
CREATE TABLE pengeluaran (
    id_pengeluaran INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    jumlah INT NOT NULL,
    keterangan TEXT,
    id_kategori INT,
    FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- =========================================================
-- Data contoh kategori (biar tidak kosong saat pertama jalan)
-- =========================================================
INSERT INTO kategori (nama_kategori, tipe) VALUES
('Gaji', 'pemasukan'),
('Bonus', 'pemasukan'),
('Uang Saku', 'pemasukan'),
('Makan', 'pengeluaran'),
('Transportasi', 'pengeluaran'),
('Kuota Internet', 'pengeluaran'),
('Hiburan', 'pengeluaran');

-- =========================================================
-- Data contoh transaksi (opsional, boleh dihapus)
-- =========================================================
INSERT INTO pemasukan (tanggal, jumlah, keterangan, id_kategori) VALUES
('2026-06-01', 1500000, 'Uang saku bulan Juni', 3),
('2026-06-10', 500000, 'Bonus lomba', 2);

INSERT INTO pengeluaran (tanggal, jumlah, keterangan, id_kategori) VALUES
('2026-06-02', 20000, 'Makan siang', 4),
('2026-06-03', 15000, 'Ongkos angkot', 5),
('2026-06-05', 100000, 'Beli kuota', 6);
