-- Active: 1683523504910@@127.0.0.1@3306@peminjaman_inventaris
SHOW TABLES;

--Menunggu
SELECT
    COUNT(`ID_Transaksi`) as Menunggu
FROM transaksi 
WHERE `ID_Status` = 'S1';

--Dikonfirmasi
SELECT
    COUNT(`ID_Transaksi`) as Konfirmasi
FROM transaksi 
WHERE `ID_Status` = 'S3' OR 'S4';

--Selesai
SELECT
    COUNT(`ID_Transaksi`) as Selesai
FROM transaksi 
WHERE `ID_Status` = 'S5';

--Belum Selesai
SELECT
    COUNT(`ID_Transaksi`) as 'Belum Selesai'
FROM transaksi 
WHERE `ID_Status` = 'S1' OR 'S3' OR 'S4';

--Dibatalkan
SELECT
    COUNT(`ID_Transaksi`) as 'Dibatalkan'
FROM transaksi 
WHERE `ID_Status` = 'S6';

--Tabel Riwayat Peminjaman 
SELECT
    t.`ID_Transaksi`, t.`StartDate`, t.`EndDate`, s.`Nama` 'Status'
FROM transaksi t
JOIN status s ON s.`ID_Status` = t.`ID_Status`
WHERE t.`ID_Status` = 'S1' OR 'S2' OR 'S3' OR 'S4';

--Stok Barang
SELECT 
    `Gambar`,`Nama`, `Stok`
FROM inventaris
ORDER BY `Stok` DESC;

--Kalender
SELECT
    `EndDate`
FROM transaksi;


