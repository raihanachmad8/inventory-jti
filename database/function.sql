--panggil data barang
--panggil data transaksi

SELECT * FROM otp


SELECT * FROM pengguna

SELECT * FROM inventaris


SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, ID_Level, Email, Status FROM pengguna
        WHERE ID_Pengguna = "Account_ID_/80Wi03b1ZldGt6S3VXWT0="

SELECT ID_Pengguna, Nama as Nama_Pengguna, Nomor_Identitas, ID_Level, Email, Status FROM pengguna
        WHERE ID_Pengguna = "Account_ID_+/80Wi03b1ZldGt6S3VXWT0="

SELECT
    I.ID_Inventaris,
    I.Nama,
    I.`Gambar`,
    I.Stok - COALESCE(SUM(DT.Jumlah), 0) AS StokTersedia,
    I.`Stok` AS Stok
FROM
    Inventaris I
LEFT JOIN
    DetailTransaksi DT ON I.ID_Inventaris = DT.ID_Inventaris
GROUP BY
    I.ID_Inventaris, I.Nama, I.Stok
HAVING
    StokTersedia > 0
ORDER BY
    I.Stok DESC;


SELECT
    t.ID_Status,
    i.ID_Inventaris,
    i.Nama as Nama_Inventaris,
    SUM(dt.Jumlah) AS TotalBorrowed
FROM
    Transaksi t
JOIN
    DetailTransaksi dt ON t.ID_Transaksi = dt.ID_Transaksi
JOIN
    Inventaris i ON dt.ID_Inventaris = i.ID_Inventaris
WHERE
    i.`ID_Inventaris` = 'I5'
GROUP BY
    t.ID_Status, i.ID_Inventaris
ORDER BY
    t.ID_Status, i.ID_Inventaris;



SELECT
    i.ID_Inventaris,
    SUM(dt.Jumlah) AS TotalBorrowed
FROM
    Transaksi t
JOIN
    DetailTransaksi dt ON t.ID_Transaksi = dt.ID_Transaksi
JOIN
    Inventaris i ON dt.ID_Inventaris = i.ID_Inventaris
JOIN
    Status s ON t.ID_Status = s.ID_Status
WHERE
     t.ID_Status NOT IN ('S2', 'S5', 'S6')
GROUP BY
    t.ID_Status, i.ID_Inventaris
ORDER BY
     i.ID_Inventaris;
