--panggil data barang
--panggil data transaksi

SELECT * FROM otp


SELECT * FROM pengguna

SELECT * FROM inventaris

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
    i.`Nama`,
    SUM(dt.Jumlah) AS TotalBorrowed,
    i.`Stok`
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


SELECT * FROM transaksi


SELECT * FROM detailtransaksi ORDER BY ID_DetailTrc DESC


SELECT *
FROM DetailTransaksi
ORDER BY CAST(SUBSTRING(ID_DetailTrc FROM 3) AS SIGNED) DESC, ID_DetailTrc

SELECT * FROM status

SELECT T.ID_Transaksi, T.ID_Pengguna, T.ID_Admin, T.StartDate, T.EndDate, T.Deskripsi_Keperluan, T.Jaminan, T.Pesan, T.ID_Status, S.`Nama` AS Nama_Status, P.`Nama` AS Nama_Pengguna, A.`Nama` AS Nama_Admin, L.`Nama` AS Nama_Level
            FROM transaksi T
            LEFT JOIN pengguna P ON T.ID_Pengguna = P.ID_Pengguna
            LEFT JOIN Level L ON P.ID_Level = L.ID_Level
            LEFT JOIN status S ON T.ID_Status = S.ID_Status
            LEFT JOIN maintainer A ON T.ID_Admin = A.ID_Maintainer
            WHERE  t.`ID_Pengguna` = "P2"


SELECT COUNT(*) as $stat FROM transaksi
LEFT JOIN status ON transaksi.ID_Status = status.ID_Status
WHERE status.ID_Status = 'S7' AND transaksi.ID_Pengguna = 'P1'

SELECT ID_Transaksi, Pesan FROM transaksi WHERE ID_Pengguna = "P2"
